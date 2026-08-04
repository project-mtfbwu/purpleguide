#!/usr/bin/env python3
"""Sanitize framework credentials after a Hostinger backup import.

This tool never prints secret values. It preserves application code where possible,
replacing environment-specific credentials with obvious placeholders. Files that
contain private-key blocks are removed entirely.
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

SENSITIVE_KEY = r"(?:password|passwd|pwd|secret|token|api[_-]?key|access[_-]?key|private[_-]?key|client[_-]?secret|encryption[_-]?key|smtp[_-]?pass|db[_-]?pass|auth[_-]?key|auth[_-]?salt|cookie[_-]?key)"
DB_CONFIG_KEY = r"(?:hostname|username|user|password|database|dbdriver|port)"

TOKEN_PATTERNS = [
    re.compile(r"\bAKIA[0-9A-Z]{16}\b"),
    re.compile(r"\bgh[pousr]_[A-Za-z0-9_]{30,}\b"),
    re.compile(r"\b(?:sk|rk)_live_[A-Za-z0-9]{16,}\b"),
    re.compile(r"\bAIza[0-9A-Za-z\-_]{30,}\b"),
    re.compile(r"\bxox[baprs]-[A-Za-z0-9-]{20,}\b"),
]

PHP_ARRAY_ASSIGNMENT = re.compile(
    rf"(?P<prefix>(?:\$[A-Za-z_][A-Za-z0-9_]*)(?:\s*\[\s*['\"][^'\"]+['\"]\s*\])*\s*\[\s*['\"](?P<key>{SENSITIVE_KEY})['\"]\s*\]\s*=\s*)(?P<quote>['\"])(?P<value>.*?)(?P=quote)(?P<suffix>\s*;)",
    re.IGNORECASE,
)
PHP_DEFINE = re.compile(
    rf"(?P<prefix>define\s*\(\s*['\"](?P<key>{SENSITIVE_KEY})['\"]\s*,\s*)(?P<quote>['\"])(?P<value>.*?)(?P=quote)(?P<suffix>\s*\)\s*;?)",
    re.IGNORECASE,
)
GENERIC_KV = re.compile(
    rf"(?P<prefix>['\"]?(?P<key>{SENSITIVE_KEY})['\"]?\s*[:=]\s*)(?P<quote>['\"])(?P<value>.*?)(?P=quote)",
    re.IGNORECASE,
)

DB_ARRAY_ASSIGNMENT = re.compile(
    rf"(?P<prefix>(?:\$db(?:\s*\[\s*['\"][^'\"]+['\"]\s*\])*)\s*\[\s*['\"](?P<key>{DB_CONFIG_KEY})['\"]\s*\]\s*=\s*)(?P<quote>['\"])(?P<value>.*?)(?P=quote)(?P<suffix>\s*;)",
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


def replacement_for(key: str) -> str:
    return PLACEHOLDERS.get(key.lower(), "change_me")


def sub_assignment(match: re.Match[str]) -> str:
    key = match.group("key")
    return f"{match.group('prefix')}{match.group('quote')}{replacement_for(key)}{match.group('quote')}{match.groupdict().get('suffix') or ''}"


def should_scan(path: Path) -> bool:
    if path.suffix.lower() in TEXT_EXTS:
        return True
    return path.name.lower() in {".htaccess", "dockerfile", "makefile"}


def is_framework_database_config(rel: str) -> bool:
    low = rel.lower()
    return low.endswith("application/config/database.php") or low.endswith("config/database.php")


def sanitize_text(text: str, database_config: bool) -> tuple[str, list[str]]:
    actions: list[str] = []
    updated = text

    if database_config:
        new = DB_ARRAY_ASSIGNMENT.sub(sub_assignment, updated)
        if new != updated:
            actions.append("replaced database connection settings")
            updated = new

    for label, pattern in (
        ("replaced sensitive PHP array assignments", PHP_ARRAY_ASSIGNMENT),
        ("replaced sensitive PHP constants", PHP_DEFINE),
        ("replaced sensitive key/value assignments", GENERIC_KV),
    ):
        new = pattern.sub(sub_assignment, updated)
        if new != updated:
            actions.append(label)
            updated = new

    # Sanitize credentials embedded in common database URLs.
    db_url = re.compile(r"(?P<prefix>\b(?:mysql|postgres(?:ql)?|mariadb):\/\/[^:\s\/@]+:)(?P<password>[^@\s\/]+)(?P<suffix>@)", re.IGNORECASE)
    new = db_url.sub(r"\g<prefix>change_me\g<suffix>", updated)
    if new != updated:
        actions.append("replaced password in a database URL")
        updated = new

    return updated, actions


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--repo", required=True, type=Path)
    args = parser.parse_args()
    repo = args.repo.resolve()

    records: list[dict[str, object]] = []
    unresolved: list[str] = []

    for path in repo.rglob("*"):
        if not path.is_file() or path.is_symlink():
            continue
        rel = path.relative_to(repo).as_posix()
        if rel.startswith(".git/") or rel.startswith(".github/"):
            continue
        if not should_scan(path):
            continue
        try:
            if path.stat().st_size > 25 * 1024 * 1024:
                continue
            text = path.read_text(errors="ignore")
        except OSError:
            continue

        if any(marker in text for marker in PRIVATE_KEY_MARKERS):
            path.unlink()
            records.append({"path": rel, "action": "removed", "reason": "contained a private-key block"})
            continue

        updated, actions = sanitize_text(text, is_framework_database_config(rel))

        # Exact token formats are never safe to retain. Replace them without writing values to logs.
        token_replaced = False
        for pattern in TOKEN_PATTERNS:
            new = pattern.sub("REDACTED_TOKEN", updated)
            if new != updated:
                token_replaced = True
                updated = new
        if token_replaced:
            actions.append("replaced credential-shaped token")

        if updated != text:
            path.write_text(updated)
            records.append({"path": rel, "action": "sanitized", "reason": "; ".join(dict.fromkeys(actions))})

    # Verify imported files only. Tooling is excluded because it contains detection strings by design.
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
        elif any(pattern.search(text) for pattern in TOKEN_PATTERNS):
            unresolved.append(rel)

    json_path = repo / "HOSTINGER_SECURITY_SANITIZATION.json"
    md_path = repo / "HOSTINGER_SECURITY_SANITIZATION.md"
    json_path.write_text(json.dumps({"records": records, "unresolved_paths": unresolved}, indent=2) + "\n")

    lines = [
        "# Hostinger Security Sanitization",
        "",
        "Generated during the Hostinger-to-GitHub import. Secret values are never included.",
        "",
        f"- Files sanitized or removed: **{len(records)}**",
        f"- Unresolved credential-bearing files: **{len(unresolved)}**",
        "",
        "## Actions",
        "",
    ]
    if records:
        lines.extend(f"- `{r['path']}` — {r['action']}: {r['reason']}" for r in records)
    else:
        lines.append("- No additional framework credentials required sanitization.")
    lines.extend(["", "## Unresolved paths", ""])
    if unresolved:
        lines.extend(f"- `{p}`" for p in unresolved)
    else:
        lines.append("- None.")
    md_path.write_text("\n".join(lines) + "\n")

    if unresolved:
        print(f"Credential verification failed for {len(unresolved)} imported file(s). Paths are listed in {md_path.name}.")
        return 1
    print(f"Sanitized or removed {len(records)} imported file(s); no unresolved credential-shaped material remains.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
