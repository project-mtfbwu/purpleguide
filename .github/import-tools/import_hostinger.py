#!/usr/bin/env python3
"""Prepare a Hostinger public_html backup for a safe GitHub import.

The script inventories the raw backup, removes known server junk and secrets,
crawls the public site, compares same-origin asset references against the backup,
and writes a Markdown/JSON audit without printing secret values.
"""
from __future__ import annotations

import argparse
import collections
import hashlib
import html
import json
import re
import shutil
import time
import urllib.parse
import xml.etree.ElementTree as ET
from dataclasses import dataclass, asdict
from pathlib import Path
from typing import Iterable

import requests
from bs4 import BeautifulSoup

TEXT_EXTS = {
    ".txt", ".md", ".html", ".htm", ".css", ".js", ".mjs", ".cjs", ".ts", ".tsx", ".jsx",
    ".json", ".xml", ".yml", ".yaml", ".php", ".py", ".rb", ".java", ".kt", ".go", ".rs",
    ".sh", ".bash", ".zsh", ".ini", ".conf", ".config", ".toml", ".properties", ".sql",
}

LFS_EXTS = {
    ".jpg", ".jpeg", ".png", ".gif", ".webp", ".avif", ".heic", ".tif", ".tiff", ".bmp", ".ico",
    ".mp4", ".mov", ".m4v", ".webm", ".mkv", ".avi", ".flv", ".wmv", ".mpeg", ".mpg",
    ".mp3", ".wav", ".m4a", ".aac", ".ogg", ".flac",
    ".pdf", ".psd", ".ai", ".eps", ".sketch", ".fig",
    ".woff", ".woff2", ".ttf", ".otf", ".eot",
    ".zip", ".7z", ".rar", ".tar", ".gz", ".bz2", ".xz", ".tgz",
    ".wasm", ".bin", ".dmg", ".apk", ".ipa",
}

EPHEMERAL_PARTS = {
    ("node_modules",), (".npm",), (".yarn", "cache"), (".pnpm-store",),
    (".next", "cache"), (".nuxt", "cache"), ("wp-content", "cache"),
    ("wp-content", "wflogs"), ("wp-content", "updraft"), ("wp-content", "ai1wm-backups"),
    ("storage", "framework", "cache"), ("storage", "framework", "sessions"),
    ("storage", "framework", "views"), ("storage", "logs"), ("var", "cache"),
    ("var", "log"), ("tmp",), ("temp",), ("logs",), ("softaculous_backups",), (".trash",),
}

SECRET_BASENAMES = {
    ".env", ".env.local", ".env.production", ".env.development", ".env.staging", ".htpasswd",
    "wp-config.php", "configuration.php", "settings.local.php", "credentials.json", "service-account.json",
    "id_rsa", "id_dsa", "id_ed25519", "auth.json",
}

PRIVATE_KEY_MARKERS = (
    "-----BEGIN PRIVATE KEY-----", "-----BEGIN RSA PRIVATE KEY-----",
    "-----BEGIN OPENSSH PRIVATE KEY-----", "-----BEGIN EC PRIVATE KEY-----",
)

SECRET_PATTERNS = [
    ("AWS access key", re.compile(r"\bAKIA[0-9A-Z]{16}\b")),
    ("GitHub token", re.compile(r"\bgh[pousr]_[A-Za-z0-9_]{30,}\b")),
    ("Stripe live key", re.compile(r"\b(?:sk|rk)_live_[A-Za-z0-9]{16,}\b")),
    ("Google API key", re.compile(r"\bAIza[0-9A-Za-z\-_]{30,}\b")),
    ("Slack token", re.compile(r"\bxox[baprs]-[A-Za-z0-9-]{20,}\b")),
    ("Database password assignment", re.compile(r"(?i)(?:DB_PASSWORD|database_password|db_pass(?:word)?)\s*[=:]\s*['\"]?[^\s'\";]{6,}")),
]

ASSET_EXTS = {
    ".css", ".js", ".mjs", ".map", ".jpg", ".jpeg", ".png", ".gif", ".webp", ".avif", ".svg", ".ico",
    ".woff", ".woff2", ".ttf", ".otf", ".eot", ".mp4", ".webm", ".mov", ".mp3", ".wav", ".pdf", ".json",
}

SOURCE_MARKERS = [
    "package.json", "package-lock.json", "pnpm-lock.yaml", "yarn.lock", "composer.json", "composer.lock",
    "vite.config.js", "vite.config.ts", "next.config.js", "next.config.mjs", "webpack.config.js", "tsconfig.json",
    "src", "app", "resources", "wp-content/themes", "wp-content/plugins",
]
BUILD_MARKERS = ["dist", "build", ".next", "public/assets", "assets", "static/js", "wp-includes"]

@dataclass
class Finding:
    severity: str
    category: str
    path: str
    reason: str


def rel_parts(path: Path, root: Path) -> tuple[str, ...]:
    return tuple(part.lower() for part in path.relative_to(root).parts)


def contains_sequence(parts: tuple[str, ...], seq: tuple[str, ...]) -> bool:
    if len(seq) > len(parts):
        return False
    return any(parts[i:i + len(seq)] == seq for i in range(len(parts) - len(seq) + 1))


def detect_root(extract_dir: Path) -> Path:
    children = [p for p in extract_dir.iterdir() if p.name not in {"__MACOSX", ".DS_Store"}]
    named = [p for p in children if p.is_dir() and p.name.lower() in {"public_html", "htdocs", "www", "html"}]
    if len(named) == 1:
        return named[0]
    if len(children) == 1 and children[0].is_dir():
        return children[0]
    return extract_dir


def sha256_file(path: Path, chunk: int = 8 * 1024 * 1024) -> str:
    h = hashlib.sha256()
    with path.open("rb") as f:
        while data := f.read(chunk):
            h.update(data)
    return h.hexdigest()


def inventory(root: Path) -> dict:
    total = 0
    count = 0
    extensions = collections.Counter()
    ext_bytes = collections.Counter()
    largest = []
    paths = set()
    for p in root.rglob("*"):
        if not p.is_file() or p.is_symlink():
            continue
        try:
            size = p.stat().st_size
        except OSError:
            continue
        rel = p.relative_to(root).as_posix()
        paths.add(rel)
        count += 1
        total += size
        ext = p.suffix.lower() or "[no extension]"
        extensions[ext] += 1
        ext_bytes[ext] += size
        largest.append((size, rel))
    largest.sort(reverse=True)
    return {"file_count": count, "total_bytes": total, "paths": paths,
            "extensions": extensions, "extension_bytes": ext_bytes, "largest": largest[:100]}


def env_example(src: Path, dst: Path) -> None:
    keys = []
    try:
        for line in src.read_text(errors="ignore").splitlines():
            m = re.match(r"^\s*(?:export\s+)?([A-Za-z_][A-Za-z0-9_]*)\s*=", line)
            if m and m.group(1) not in keys:
                keys.append(m.group(1))
    except OSError:
        return
    if keys and not dst.exists():
        dst.parent.mkdir(parents=True, exist_ok=True)
        dst.write_text("\n".join(f"{key}=" for key in keys) + "\n")


def wp_config_example(src: Path, dst: Path) -> None:
    constants = []
    try:
        text = src.read_text(errors="ignore")
    except OSError:
        return
    for name in re.findall(r"define\s*\(\s*['\"]([A-Z0-9_]+)['\"]", text):
        if name not in constants:
            constants.append(name)
    safe_defaults = {"DB_NAME": "database_name", "DB_USER": "database_user", "DB_PASSWORD": "change_me",
                     "DB_HOST": "localhost", "DB_CHARSET": "utf8mb4", "DB_COLLATE": "",
                     "WP_HOME": "https://example.com", "WP_SITEURL": "https://example.com"}
    secret_names = {"AUTH_KEY", "SECURE_AUTH_KEY", "LOGGED_IN_KEY", "NONCE_KEY", "AUTH_SALT",
                    "SECURE_AUTH_SALT", "LOGGED_IN_SALT", "NONCE_SALT"}
    lines = ["<?php", "/** Sanitized example generated during the Hostinger-to-GitHub import. */"]
    for name in constants:
        if name in secret_names:
            lines.append(f"define('{name}', 'replace-with-a-unique-secret');")
        elif name == "WP_DEBUG":
            lines.append("define('WP_DEBUG', false);")
        else:
            lines.append(f"define('{name}', '{safe_defaults.get(name, 'replace_me')}');")
    lines.extend(["", "$table_prefix = 'wp_';", "", "/* Add environment-specific settings outside version control. */", ""])
    dst.parent.mkdir(parents=True, exist_ok=True)
    dst.write_text("\n".join(lines))


def should_skip(path: Path, root: Path) -> tuple[bool, str]:
    parts = rel_parts(path, root)
    basename = path.name.lower()
    rel = "/".join(parts)
    if any(contains_sequence(parts, seq) for seq in EPHEMERAL_PARTS):
        return True, "generated cache, log, temporary, dependency, or server-backup content"
    if ".well-known/acme-challenge" in rel:
        return True, "temporary TLS challenge file"
    if basename in SECRET_BASENAMES or (basename.startswith(".env.") and basename != ".env.example"):
        return True, "known secret-bearing configuration file"
    if basename.endswith((".sql", ".sql.gz", ".sqlite", ".sqlite3")):
        return True, "database dump or local database file"
    if basename.endswith((".log", ".pid", ".sock")):
        return True, "runtime log/process file"
    if re.search(r"(?i)(backup|back-up|old-copy|copy-of|fullbackup|softaculous).*(\.zip|\.tar|\.gz|\.tgz|\.7z|\.rar|\.bak)$", basename):
        return True, "backup archive"
    if basename in {"error_log", "debug.log", "access.log"}:
        return True, "server log"
    return False, ""


def looks_secret(path: Path) -> str | None:
    try:
        if path.stat().st_size > 5 * 1024 * 1024:
            return None
    except OSError:
        return None
    if path.suffix.lower() not in TEXT_EXTS and path.name not in {".htaccess", "Dockerfile", "Makefile"}:
        return None
    try:
        text = path.read_text(errors="ignore")
    except OSError:
        return None
    if any(marker in text for marker in PRIVATE_KEY_MARKERS):
        return "private key material"
    for label, pattern in SECRET_PATTERNS:
        if pattern.search(text):
            return label
    return None


def copy_clean(source: Path, repo: Path) -> tuple[list[Finding], dict]:
    findings = []
    copied = 0
    copied_bytes = 0
    lfs_exts = set()
    oversized = []
    preserve = {repo / ".git", repo / ".github"}
    for child in list(repo.iterdir()):
        if child in preserve:
            continue
        shutil.rmtree(child) if child.is_dir() else child.unlink()
    for src in source.rglob("*"):
        rel = src.relative_to(source)
        if not rel.parts:
            continue
        if rel.parts[0] in {".git", ".github"}:
            findings.append(Finding("warning", "reserved path", rel.as_posix(), "not copied because import tooling owns this path"))
            continue
        if src.is_symlink():
            findings.append(Finding("warning", "symlink", rel.as_posix(), "symlink skipped for repository safety"))
            continue
        if src.is_dir():
            continue
        skip, reason = should_skip(src, source)
        dst = repo / rel
        if skip:
            findings.append(Finding("info", "excluded", rel.as_posix(), reason))
            if src.name.lower().startswith(".env"):
                env_example(src, dst.parent / ".env.example")
            elif src.name.lower() == "wp-config.php":
                wp_config_example(src, dst.parent / "wp-config.example.php")
            continue
        secret_reason = looks_secret(src)
        if secret_reason:
            findings.append(Finding("warning", "possible secret", rel.as_posix(), f"excluded after detecting {secret_reason}"))
            continue
        dst.parent.mkdir(parents=True, exist_ok=True)
        shutil.copy2(src, dst)
        size = src.stat().st_size
        copied += 1
        copied_bytes += size
        ext = src.suffix.lower()
        if ext in LFS_EXTS or size >= 10 * 1024 * 1024:
            if ext:
                lfs_exts.add(ext)
            else:
                oversized.append((size, rel.as_posix()))
        if size > 2 * 1024 * 1024 * 1024:
            oversized.append((size, rel.as_posix()))
    return findings, {"copied_files": copied, "copied_bytes": copied_bytes,
                      "lfs_extensions": sorted(lfs_exts), "oversized": sorted(oversized, reverse=True)}


def normalize_same_origin(url: str, base: str) -> str | None:
    absolute = urllib.parse.urljoin(base, html.unescape(url.strip()))
    parsed = urllib.parse.urlparse(absolute)
    base_parsed = urllib.parse.urlparse(base)
    if parsed.scheme not in {"http", "https"} or parsed.netloc.lower() != base_parsed.netloc.lower():
        return None
    return re.sub(r"/+", "/", urllib.parse.unquote(parsed.path or "/"))


def extract_urls(response: requests.Response, site_url: str) -> tuple[set[str], set[str]]:
    links, assets = set(), set()
    content_type = response.headers.get("content-type", "")
    text = response.text
    if "html" in content_type or "<html" in text[:1000].lower():
        soup = BeautifulSoup(text, "html.parser")
        attr_map = {"a": ["href"], "link": ["href"], "script": ["src"],
                    "img": ["src", "data-src", "srcset"], "source": ["src", "srcset"],
                    "video": ["src", "poster"], "audio": ["src"], "iframe": ["src"]}
        for tag_name, attrs in attr_map.items():
            for tag in soup.find_all(tag_name):
                for attr in attrs:
                    value = tag.get(attr)
                    if not value:
                        continue
                    values = [part.strip().split(" ")[0] for part in value.split(",")] if attr == "srcset" else [value]
                    for item in values:
                        path = normalize_same_origin(item, site_url)
                        if not path:
                            continue
                        if Path(path).suffix.lower() in ASSET_EXTS or tag_name in {"script", "img", "source", "video", "audio", "link"}:
                            assets.add(path)
                        if tag_name == "a" and not Path(path).suffix:
                            links.add(path)
        for style in soup.find_all(style=True):
            for raw in re.findall(r"url\(([^)]+)\)", style.get("style", "")):
                if path := normalize_same_origin(raw.strip(" '\""), site_url):
                    assets.add(path)
    elif "css" in content_type:
        for raw in re.findall(r"url\(([^)]+)\)", text):
            if path := normalize_same_origin(raw.strip(" '\""), site_url):
                assets.add(path)
    return links, assets


def crawl(site_url: str, max_pages: int = 250) -> dict:
    site_url = site_url.rstrip("/") + "/"
    session = requests.Session()
    session.headers.update({"User-Agent": "PurpleGuide-Backup-Audit/1.0 (+repository migration)"})
    queue = collections.deque(["/"])
    visited, assets = set(), set()
    statuses, errors = {}, []
    for special in ("/robots.txt", "/sitemap.xml", "/sitemap_index.xml"):
        try:
            r = session.get(urllib.parse.urljoin(site_url, special), timeout=20, allow_redirects=True)
            statuses[special] = r.status_code
            if r.ok and ("xml" in r.headers.get("content-type", "") or special.endswith(".xml")):
                try:
                    root = ET.fromstring(r.text)
                    for loc in root.findall(".//{*}loc"):
                        if loc.text and (p := normalize_same_origin(loc.text, site_url)) and p not in visited:
                            queue.append(p)
                except ET.ParseError:
                    pass
        except requests.RequestException as exc:
            errors.append(f"{special}: {type(exc).__name__}")
    while queue and len(visited) < max_pages:
        path = queue.popleft()
        if path in visited:
            continue
        visited.add(path)
        try:
            r = session.get(urllib.parse.urljoin(site_url, path.lstrip("/")), timeout=20, allow_redirects=True)
            statuses[path] = r.status_code
            if r.ok:
                links, found_assets = extract_urls(r, site_url)
                assets.update(found_assets)
                for link in links:
                    if link not in visited and len(queue) < max_pages * 3:
                        queue.append(link)
        except requests.RequestException as exc:
            statuses[path] = type(exc).__name__
            errors.append(f"{path}: {type(exc).__name__}")
        time.sleep(0.03)
    asset_status = {}
    for path in sorted(assets)[:1500]:
        try:
            r = session.get(urllib.parse.urljoin(site_url, path.lstrip("/")), timeout=20, stream=True, allow_redirects=True)
            asset_status[path] = r.status_code
            r.close()
        except requests.RequestException as exc:
            asset_status[path] = type(exc).__name__
    return {"site_url": site_url, "visited_routes": sorted(visited), "route_status": statuses,
            "assets": sorted(assets), "asset_status": asset_status, "errors": errors}


def local_candidates(path: str) -> list[str]:
    clean = path.lstrip("/")
    candidates = [clean]
    if not clean:
        candidates += ["index.html", "index.php"]
    elif clean.endswith("/"):
        candidates += [clean + "index.html", clean + "index.php"]
    elif not Path(clean).suffix:
        candidates += [clean + ".html", clean + ".php", clean + "/index.html", clean + "/index.php"]
    return list(dict.fromkeys(candidates))


def omission_analysis(raw_paths: set[str], crawl_data: dict) -> dict:
    lower_paths = {p.lower() for p in raw_paths}
    missing_assets, present_assets = [], []
    for asset in crawl_data.get("assets", []):
        if any(c.lower() in lower_paths for c in local_candidates(asset)):
            present_assets.append(asset)
        else:
            missing_assets.append(asset)
    source_hits, build_hits = [], []
    for marker in SOURCE_MARKERS:
        marker_l = marker.lower().rstrip("/")
        if marker_l in lower_paths or any(p.startswith(marker_l + "/") for p in lower_paths):
            source_hits.append(marker)
    for marker in BUILD_MARKERS:
        marker_l = marker.lower().rstrip("/")
        if marker_l in lower_paths or any(p.startswith(marker_l + "/") for p in lower_paths):
            build_hits.append(marker)
    if any(p.startswith("wp-content/") for p in lower_paths) and any(p.startswith("wp-includes/") for p in lower_paths):
        framework = "WordPress/PHP"
    elif "artisan" in lower_paths or ("composer.json" in lower_paths and any(p.startswith("app/") for p in lower_paths)):
        framework = "Laravel/PHP"
    elif "package.json" in lower_paths:
        framework = "JavaScript application"
    elif any(p.endswith(".php") for p in lower_paths):
        framework = "PHP website"
    elif any(p.endswith(".html") for p in lower_paths):
        framework = "static/compiled website"
    else:
        framework = "unknown"
    suspicious, expected = [], []
    if framework == "WordPress/PHP":
        expected.append("The MySQL database is outside public_html and is not expected inside this ZIP; export it separately from Hostinger/phpMyAdmin.")
        if not any(p.startswith("wp-content/themes/") for p in lower_paths):
            suspicious.append("WordPress core appears present but no theme files were found.")
        if not any(p.startswith("wp-content/plugins/") for p in lower_paths):
            suspicious.append("WordPress core appears present but no plugin files were found.")
    if build_hits and not source_hits and framework != "WordPress/PHP":
        suspicious.append("Compiled/build output exists, but normal source/project markers were not found. This may be a deployment-only upload rather than the original developer repository.")
    if not any(p in lower_paths for p in {"package.json", "composer.json", "index.php", "index.html"}):
        suspicious.append("No common application manifest or entry file was found at the archive root.")
    if missing_assets:
        suspicious.append(f"{len(missing_assets)} same-origin assets referenced by the live site were not matched to a file in the backup. Some may be generated routes, CDN rewrites, or case differences.")
    expected.extend([
        "Hostinger account settings, DNS, SSL certificates, cron jobs, email mailboxes, and database contents normally live outside public_html.",
        "Runtime cache, logs, sessions, TLS challenge files, local dependency folders, and backup archives were intentionally excluded from GitHub.",
    ])
    confidence = "low"
    if framework != "unknown" and len(crawl_data.get("assets", [])) >= 10:
        confidence = "medium"
    if framework == "WordPress/PHP" and any(p.startswith("wp-content/themes/") for p in lower_paths):
        confidence = "medium-high"
    return {"framework_guess": framework, "source_markers": source_hits, "build_markers": build_hits,
            "present_live_assets": present_assets, "missing_live_assets": missing_assets,
            "expected_omissions": expected, "suspicious_omissions": suspicious, "confidence": confidence}


def human_bytes(n: int) -> str:
    value = float(n)
    for unit in ["B", "KB", "MB", "GB", "TB"]:
        if value < 1024 or unit == "TB":
            return f"{value:.2f} {unit}"
        value /= 1024
    return f"{n} B"


def write_git_files(repo: Path, lfs_exts: Iterable[str]) -> None:
    attrs = ["# Generated for the Hostinger import. Git LFS keeps the repository push below GitHub's normal object limits."]
    for ext in sorted(set(lfs_exts)):
        attrs.append(f"*{ext} filter=lfs diff=lfs merge=lfs -text")
    attrs.extend(["*.svg text eol=lf", "*.php text eol=lf", "*.js text eol=lf", "*.css text eol=lf"])
    (repo / ".gitattributes").write_text("\n".join(attrs) + "\n")
    (repo / ".gitignore").write_text("""# Secrets and environment-specific configuration
.env
.env.*
!.env.example
wp-config.php
.htpasswd
*.pem
*.key
id_rsa*
id_dsa*
id_ed25519*

# Databases and server backups
*.sql
*.sql.gz
*.sqlite
*.sqlite3
*backup*.zip
*backup*.tar*
*.bak

# Dependencies and runtime output
node_modules/
.npm/
.pnpm-store/
.yarn/cache/
.next/cache/
.nuxt/cache/
wp-content/cache/
wp-content/wflogs/
wp-content/updraft/
wp-content/ai1wm-backups/
storage/framework/cache/
storage/framework/sessions/
storage/framework/views/
storage/logs/
var/cache/
var/log/
logs/
tmp/
temp/
*.log
error_log
.DS_Store
Thumbs.db
""")


def write_report(repo: Path, archive: Path, raw: dict, clean: dict, findings: list[Finding], crawl_data: dict, omissions: dict) -> None:
    report_json = {"archive": {"name": archive.name, "size_bytes": archive.stat().st_size, "sha256": sha256_file(archive)},
                   "raw_inventory": {"file_count": raw["file_count"], "total_bytes": raw["total_bytes"],
                                     "extensions": dict(raw["extensions"]), "extension_bytes": dict(raw["extension_bytes"]),
                                     "largest": raw["largest"]},
                   "clean_import": clean, "findings": [asdict(f) for f in findings],
                   "live_site": crawl_data, "omission_analysis": omissions}
    (repo / "HOSTINGER_IMPORT_AUDIT.json").write_text(json.dumps(report_json, indent=2, ensure_ascii=False) + "\n")
    excluded = [f for f in findings if f.category in {"excluded", "possible secret", "reserved path", "symlink"}]
    warning_rows = [f for f in findings if f.severity == "warning"]
    missing = omissions["missing_live_assets"]
    largest_lines = "\n".join(f"| `{path}` | {human_bytes(size)} |" for size, path in raw["largest"][:30]) or "| — | — |"
    suspicious_lines = "\n".join(f"- {item}" for item in omissions["suspicious_omissions"]) or "- No clear suspicious omission was detected from the available evidence."
    expected_lines = "\n".join(f"- {item}" for item in omissions["expected_omissions"])
    missing_lines = "\n".join(f"- `{p}`" for p in missing[:200]) or "- None found."
    warning_lines = "\n".join(f"- `{f.path}` — {f.reason}" for f in warning_rows[:200]) or "- None."
    md = f"""# Hostinger Import & Missing-File Audit

Generated automatically from the supplied `public_html.zip` and the live site `{crawl_data['site_url']}`.

## Import summary

- Raw archive: **{human_bytes(archive.stat().st_size)}** (`{archive.name}`)
- Raw extracted files: **{raw['file_count']:,}** totaling **{human_bytes(raw['total_bytes'])}**
- Clean files copied to GitHub: **{clean['copied_files']:,}** totaling **{human_bytes(clean['copied_bytes'])}**
- Files/paths excluded or flagged: **{len(excluded):,}**
- Framework guess: **{omissions['framework_guess']}**
- Missing-file conclusion confidence: **{omissions['confidence']}**
- Live routes checked: **{len(crawl_data.get('visited_routes', [])):,}**
- Same-origin live assets discovered: **{len(crawl_data.get('assets', [])):,}**
- Live assets not matched in backup: **{len(missing):,}**

## Did the developer intentionally skip files?

This audit can identify signs of a deployment-only package or missing live assets, but it cannot prove intent. The strongest evidence is below.

### Suspicious or worth checking

{suspicious_lines}

### Normal/expected omissions

{expected_lines}

## Live assets not matched to the backup

These are public same-origin asset paths referenced during the crawl but not found at the same relative path in the ZIP. URL rewriting, generated assets, CDN behavior, or filename case can create false positives.

{missing_lines}

## Security and cleanup warnings

Only paths and reasons are shown. Secret values are never written to this report.

{warning_lines}

## Largest files in the raw backup

| Path | Size |
|---|---:|
{largest_lines}

## What was deliberately not committed

- Secret-bearing environment/configuration files, private keys, database dumps, logs, caches, sessions, dependency caches, TLS challenge files, and recognizable backup archives.
- `wp-config.php` is replaced with a sanitized `wp-config.example.php` when found.
- `.env` files are replaced with key-only `.env.example` files when possible.
- The original ZIP is not committed.

## Important restore note

A `public_html` ZIP is not automatically a complete website backup. For database-driven sites, also export the database and record Hostinger settings such as PHP version, cron jobs, redirects, environment variables, email/DNS configuration, and deployment commands. Keep that material in a secure backup, not in GitHub.
"""
    (repo / "HOSTINGER_IMPORT_AUDIT.md").write_text(md)


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--archive", required=True, type=Path)
    parser.add_argument("--extract-dir", required=True, type=Path)
    parser.add_argument("--repo", required=True, type=Path)
    parser.add_argument("--site-url", required=True)
    args = parser.parse_args()
    source = detect_root(args.extract_dir.resolve())
    repo = args.repo.resolve()
    archive = args.archive.resolve()
    print(f"Detected website root: {source}")
    raw = inventory(source)
    print(f"Raw inventory: {raw['file_count']} files, {human_bytes(raw['total_bytes'])}")
    crawl_data = crawl(args.site_url)
    omissions = omission_analysis(raw["paths"], crawl_data)
    findings, clean = copy_clean(source, repo)
    if clean["oversized"]:
        for size, path in clean["oversized"]:
            findings.append(Finding("warning", "oversized", path, f"file is {human_bytes(size)}; verify Git LFS plan limits"))
    write_git_files(repo, clean["lfs_extensions"])
    write_report(repo, archive, raw, clean, findings, crawl_data, omissions)
    print(f"Clean import: {clean['copied_files']} files, {human_bytes(clean['copied_bytes'])}")
    print(f"Audit: {repo / 'HOSTINGER_IMPORT_AUDIT.md'}")
    return 0

if __name__ == "__main__":
    raise SystemExit(main())
