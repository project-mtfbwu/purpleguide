#!/usr/bin/env python3
"""Sanitize high-confidence credentials in an imported Hostinger website.

The sanitizer is deliberately conservative: it replaces exact credential formats
anywhere, but only rewrites generic assignments inside application-owned config
and endpoint files. Third-party frameworks and minified libraries are never
rewritten merely because they contain words such as "token" or "password".
Secret values are never printed or written to reports.
"""
from __future__ import annotations

import argparse
import json
import re
from pathlib import Path

TEXT_EXTS = {
    ".php", ".ini", ".conf", ".config", ".json", ".yml", ".yaml", ".xml",
    ".js", ".ts", ".py", ".rb", ".properties", ".toml", ".txt", ".env",
}

PRIVATE_KEY_MARKERS = (
    "-----BEGIN PRIVATE KEY-----",
    "-----BEGIN RSA PRIVATE KEY-----",
    "-----BEGIN OPENSSH PRIVATE KEY-----",
    "-----BEGIN EC PRIVATE KEY-----",
    "-----BEGIN DSA PRIVATE KEY-----",
)

TOKEN_PATTERNS: list[tuple[str, re.Pattern[str]]] = [
    ("AWS access key", re.compile(r"\bAKIA[0-9A-Z]{16}\b")),
    ("GitHub token", re.compile(r"\bgh[pousr]_[A-Za-z0-9_]{30,}\b")),
    ("GitLab token", re.compile(r"\bglpat-[A-Za-z0-9_-]{20,}\b")),
    ("Stripe live key", re.compile(r"\b(?:sk|rk)_live_[A-Za-z0-9]{16,}\b")),
    ("Google API key", re.compile(r"\bAIza[0-9A-Za-z\-_]{30,}\b")),
    ("Google OAuth secret", re.compile(r"\bGOCSPX-[0-9A-Za-z_-]{20,}\b")),
    ("Slack token", re.compile(r"\bxox[baprs]-[A-Za-z0-9-]{20,}\b")),
    ("SendGrid key", re.compile(r"\bSG\.[A-Za-z0-9_-]{16,}\.[A-Za-z0-9_-]{20,}\b")),
    ("Razorpay live key", re.compile(r"\brzp_live_[A-Za-z0-9]{12,}\b")),
]

SENSITIVE_KEY = (
    r"(?:password|passwd|pwd|secret|secret_key|api[_-]?key|access[_-]?key|"
    r"private[_-]?key|client[_-]?secret|encryption[_-]?key|smtp[_-]?pass|"
    r"db[_-]?pass(?:word)?|auth[_-]?key|auth[_-]?salt|cookie[_-]?key)"
)
DB_CONFIG_KEY = r"(?:hostname|username|user|password|database|dbdriver|port)"

PHP_ARRAY_ASSIGNMENT = re.compile(
    rf"(?P<prefix>(?:\$[A-Za-z_][A-Za-z0-9_]*)(?:\s*\[\s*['\"][^'\"]+['\"]\s*\])*"
    rf"\s*\[\s*['\"](?P<key>{SENSITIVE_KEY})['\"]\s*\]\s*=\s*)"
    rf"(?P<quote>['\"])(?P<value>.*?)(?P=quote)(?P<suffix>\s*;)",
    re.IGNORECASE,
)
PHP_DEFINE = re.compile(
    rf"(?P<prefix>define\s*\(\s*['\"](?P<key>{SENSITIVE_KEY})['\"]\s*,\s*)"
    rf"(?P<quote>['\"])(?P<value>.*?)(?P=quote)(?P<suffix>\s*\)\s*;?)",
    re.IGNORECASE,
)
PHP_PROPERTY_ASSIGNMENT = re.compile(
    rf"(?P<prefix>->\s*(?P<key>{SENSITIVE_KEY}|Username)\s*=\s*)"
    rf"(?P<quote>['\"])(?P<value>.*?)(?P=quote)(?P<suffix>\s*;)",
    re.IGNORECASE,
)
GENERIC_KV = re.compile(
    rf"(?P<prefix>['\"]?(?P<key>{SENSITIVE_KEY})['\"]?\s*[:=]\s*)"
    rf"(?P<quote>['\"])(?P<value>.*?)(?P=quote)",
    re.IGNORECASE,
)
DB_ARRAY_ASSIGNMENT = re.compile(
    rf"(?P<prefix>(?:\$db(?:\s*\[\s*['\"][^'\"]+['\"]\s*\])*)"
    rf"\s*\[\s*['\"](?P<key>{DB_CONFIG_KEY})['\"]\s*\]\s*=\s*)"
    rf"(?P<quote>['\"])(?P<value>.*?)(?P=quote)(?P<suffix>\s*;)",
    re.IGNORECASE,
)
DB_ARRAY_PAIR = re.compile(
    rf"(?P<prefix>['\"](?P<key>{DB_CONFIG_KEY})['\"]\s*=>\s*)"
    rf"(?P<quote>['\"])(?P<value>.*?)(?P=quote)",
    re.IGNORECASE,
)
DB_URL = re.compile(
    r"(?P<prefix>\b(?:mysql|postgres(?:ql)?|mariadb):\/\/[^:\s\/@]+:)"
    r"(?P<password>[^@\s\/]+)(?P<suffix>@)",
    re.IGNORECASE,
)

PLACEHOLDERS = {
    "hostname": "localhost",
    "username": "database_user",
    "user": "database_user",
    "password": "change_me",
    "database": "database_name",
    "dbdriver": "mysqli",
    "port": "3306",
}

THIRD_PARTY_SEQUENCES = (
    "/system/",
    "/vendor/",
    "/node_modules/",
    "/assets/libs/",
    "/assets/plugins/",
    "/material/assets/libs/",
    "/material/assets/extra-libs/",
    "/ckeditor/",
    "/tinymce/",
    "/phpmailer/",
)


def replacement_for(key: str) -> str:
    return PLACEHOLDERS.get(key.lower(), "change_me")


def sub_assignment(match: re.Match[str]) -> str:
    key = match.group("key")
    suffix = match.groupdict().get("suffix") or ""
    return (
        f"{match.group('prefix')}{match.group('quote')}"
        f"{replacement_for(key)}{match.group('quote')}{suffix}"
    )


def should_scan(path: Path) -> bool:
    return path.suffix.lower() in TEXT_EXTS or path.name.lower() in {
        ".htaccess", "dockerfile", "makefile"
    }


def is_third_party(rel: str) -> bool:
    normalized = f"/{rel.lower().strip('/')}/"
    return any(sequence in normalized for sequence in THIRD_PARTY_SEQUENCES)


def is_database_config(rel: str) -> bool:
    low = rel.lower()
    return low.endswith("application/config/database.php") or low.endswith("config/database.php")


def is_owned_config(rel: str) -> bool:
    low = rel.lower()
    name = Path(low).name
    return (
        "/application/config/" in f"/{low}"
        or name in {"wp-config.php", "configuration.php", "settings.php", "settings.local.php"}
        or name.startswith(".env")
    )


def is_owned_endpoint(rel: str) -> bool:
    low = rel.lower()
    if is_third_party(rel):
        return False
    if any(segment in f"/{low}" for segment in (
        "/application/controllers/", "/application/models/", "/application/views/"
    )):
        return Path(low).suffix == ".php"
    return (
        low.startswith("assets/email-templates/")
        and "/phpmailer/" not in f"/{low}"
        and Path(low).suffix == ".php"
    )


def sanitize_assignments(text: str, *, database: bool, generic: bool) -> tuple[str, list[str]]:
    updated = text
    actions: list[str] = []

    if database:
        for label, pattern in (
            ("replaced database connection assignments", DB_ARRAY_ASSIGNMENT),
            ("replaced database connection array values", DB_ARRAY_PAIR),
        ):
            new = pattern.sub(sub_assignment, updated)
            if new != updated:
                actions.append(label)
                updated = new

    for label, pattern in (
        ("replaced sensitive PHP array assignments", PHP_ARRAY_ASSIGNMENT),
        ("replaced sensitive PHP constants", PHP_DEFINE),
        ("replaced sensitive PHP object properties", PHP_PROPERTY_ASSIGNMENT),
    ):
        new = pattern.sub(sub_assignment, updated)
        if new != updated:
            actions.append(label)
            updated = new

    if generic:
        new = GENERIC_KV.sub(sub_assignment, updated)
        if new != updated:
            actions.append("replaced sensitive configuration key/value assignments")
            updated = new

    new = DB_URL.sub(r"\g<prefix>change_me\g<suffix>", updated)
    if new != updated:
        actions.append("replaced password in a database URL")
        updated = new

    return updated, actions


def replace_exact_tokens(text: str) -> tuple[str, list[str]]:
    updated = text
    labels: list[str] = []
    for label, pattern in TOKEN_PATTERNS:
        new = pattern.sub("REDACTED_CREDENTIAL", updated)
        if new != updated:
            labels.append(f"replaced {label}")
            updated = new
    return updated, labels


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--repo", required=True, type=Path)
    args = parser.parse_args()
    repo = args.repo.resolve()

    records: list[dict[str, str]] = []
    unresolved: list[str] = []

    for path in repo.rglob("*"):
        if not path.is_file() or path.is_symlink():
            continue
        rel = path.relative_to(repo).as_posix()
        if rel.startswith(".git/") or rel.startswith(".github/") or not should_scan(path):
            continue
        try:
            if path.stat().st_size > 25 * 1024 * 1024:
                continue
            text = path.read_text(errors="ignore")
        except OSError:
            continue

        if any(marker in text for marker in PRIVATE_KEY_MARKERS):
            path.unlink()
            records.append({
                "path": rel,
                "action": "removed",
                "reason": "contained a private-key block",
            })
            continue

        updated, actions = replace_exact_tokens(text)

        owned_config = is_owned_config(rel)
        owned_endpoint = is_owned_endpoint(rel)
        if owned_config or owned_endpoint:
            updated, assignment_actions = sanitize_assignments(
                updated,
                database=is_database_config(rel),
                generic=owned_config,
            )
            actions.extend(assignment_actions)

        if updated != text:
            path.write_text(updated)
            records.append({
                "path": rel,
                "action": "sanitized",
                "reason": "; ".join(dict.fromkeys(actions)),
            })

    # Verify only high-confidence credential formats and private-key blocks.
    for path in repo.rglob("*"):
        if not path.is_file() or path.is_symlink():
            continue
        rel = path.relative_to(repo).as_posix()
        if rel.startswith(".git/") or rel.startswith(".github/") or not should_scan(path):
            continue
        try:
            if path.stat().st_size > 25 * 1024 * 1024:
                continue
            text = path.read_text(errors="ignore")
        except OSError:
            continue
        if any(marker in text for marker in PRIVATE_KEY_MARKERS):
            unresolved.append(rel)
        elif any(pattern.search(text) for _, pattern in TOKEN_PATTERNS):
            unresolved.append(rel)

    json_path = repo / "HOSTINGER_SECURITY_SANITIZATION.json"
    md_path = repo / "HOSTINGER_SECURITY_SANITIZATION.md"
    json_path.write_text(json.dumps({
        "records": records,
        "unresolved_paths": unresolved,
        "policy": "Exact credential formats globally; generic assignments only in application-owned configs and endpoints.",
    }, indent=2) + "\n")

    lines = [
        "# Hostinger Security Sanitization",
        "",
        "Generated during the Hostinger-to-GitHub import. Secret values are never included.",
        "",
        f"- Files sanitized or removed: **{len(records)}**",
        f"- Unresolved credential-bearing files: **{len(unresolved)}**",
        "- Third-party framework and minified library code was not generically rewritten.",
        "",
        "## Actions",
        "",
    ]
    if records:
        lines.extend(
            f"- `{record['path']}` — {record['action']}: {record['reason']}"
            for record in records
        )
    else:
        lines.append("- No high-confidence credentials required sanitization.")
    lines.extend(["", "## Unresolved paths", ""])
    lines.extend(f"- `{path}`" for path in unresolved) if unresolved else lines.append("- None.")
    md_path.write_text("\n".join(lines) + "\n")

    if unresolved:
        print(
            f"Credential verification failed for {len(unresolved)} imported file(s). "
            f"Paths are listed in {md_path.name}."
        )
        return 1
    print(
        f"Sanitized or removed {len(records)} imported file(s); "
        "no unresolved high-confidence credential formats remain."
    )
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
