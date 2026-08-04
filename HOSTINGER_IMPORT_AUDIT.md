# Hostinger Import & Missing-File Audit

Generated automatically from the supplied `public_html.zip` and the live site `https://purpleguide.study/`.

## Import summary

- Raw archive: **2.47 GB** (`public_html.zip`)
- Raw extracted files: **21,788** totaling **2.46 GB**
- Clean files copied to GitHub: **21,665** totaling **394.71 MB**
- Files/paths excluded or flagged: **124**
- Framework guess: **PHP website**
- Missing-file conclusion confidence: **medium**
- Live routes checked: **30**
- Same-origin live assets discovered: **230**
- Live assets not matched at the same path: **5** (**4 reconciled through `/admin` → `/pgs_admin` aliasing; 1 unresolved**)

## Did the developer intentionally skip files?

This audit can identify signs of a deployment-only package or missing live assets, but it cannot prove intent. The strongest evidence is below.

### Suspicious or worth checking

- 5 same-origin assets referenced by the live site were not matched to a file in the backup. Some may be generated routes, CDN rewrites, or case differences.

### Normal/expected omissions

- Hostinger account settings, DNS, SSL certificates, cron jobs, email mailboxes, and database contents normally live outside public_html.
- Runtime cache, logs, sessions, TLS challenge files, local dependency folders, and backup archives were intentionally excluded from GitHub.

## Live assets not matched to the backup

These are public same-origin asset paths referenced during the crawl but not found at the same relative path in the ZIP. URL rewriting, generated assets, CDN behavior, or filename case can create false positives.

- `/admin/assets/images/13721764058641.jpg`
- `/admin/assets/images/20871773827749.jpeg`
- `/admin/assets/images/31721781612391.png`
- `/admin/assets/images/50791783924759.png`
- `/assets/demos/marketing/marketing.css`

## Post-audit path reconciliation

A filename-level check against the imported repository found that the four image files listed under `/admin/assets/images/` are present under `pgs_admin/assets/images/`. The live server is therefore likely exposing `pgs_admin` through an `/admin` route alias or rewrite. These four images were **not skipped** from the backup.

The only live path still unmatched is:

- `/assets/demos/marketing/marketing.css`

**Revised conclusion:** one public CSS path remains unresolved. That is worth checking with the developer, but the available evidence does not prove it was intentionally withheld; it may be generated, renamed, served by a rewrite, or stale HTML.

## Security and cleanup warnings

Only paths and reasons are shown. Secret values are never written to this report.

- `application/views/contact.php` — copied for sanitization after detecting Google API key

## Largest files in the raw backup

| Path | Size |
|---|---:|
| `purplebackup1.zip` | 1.18 GB |
| `assets/css.zip` | 502.30 MB |
| `assets/img/img.zip` | 164.06 MB |
| `assets/img/about.png.zip` | 145.77 MB |
| `pgs_admin/application.zip` | 71.61 MB |
| `assets/img/reading-book-boy.png` | 14.84 MB |
| `assets/images/7941781437589.png` | 12.25 MB |
| `assets/img/doctor.png` | 11.15 MB |
| `assets/img/saved_1.jpg` | 10.37 MB |
| `assets/videos/uhd_25fps.mp4` | 10.05 MB |
| `assets/img/author.png` | 9.92 MB |
| `assets/img/reading-book-girl.jpg` | 9.62 MB |
| `pgs_admin/assets/images/37201784113676.png` | 9.05 MB |
| `assets/img/step.png` | 8.99 MB |
| `assets/img/uni.jpg` | 8.85 MB |
| `assets/img/computer.jpg` | 8.24 MB |
| `assets/img/green-1.png` | 8.07 MB |
| `assets/img/img-about.jpg` | 7.76 MB |
| `pgs_admin/assets/plugins.zip` | 7.69 MB |
| `assets/img/meet-laptop.jpg` | 6.68 MB |
| `assets/img/read-you-girl.jpg` | 6.67 MB |
| `assets/img/avatar.jpg` | 6.38 MB |
| `application/pgs.zip` | 6.11 MB |
| `pgs_admin/assets/images/47351772695332.png` | 5.78 MB |
| `assets/img/girl-pick-1.jpg` | 5.48 MB |
| `application/cache.zip` | 5.05 MB |
| `pgs_admin/assets/plugins/fontawesome/metadata/icon-families.json` | 4.48 MB |
| `pgs_admin/assets/plugins/fontawesome/metadata/icons.json` | 4.07 MB |
| `assets/img/girl-with-book.jpg` | 4.04 MB |
| `assets/img/degree-with-girl.png` | 3.88 MB |

## What was deliberately not committed

- Secret-bearing environment/configuration files, private keys, database dumps, logs, caches, sessions, dependency caches, TLS challenge files, and recognizable backup archives.
- `wp-config.php` is replaced with a sanitized `wp-config.example.php` when found.
- `.env` files are replaced with key-only `.env.example` files when possible.
- The original ZIP is not committed.

## Important restore note

A `public_html` ZIP is not automatically a complete website backup. For database-driven sites, also export the database and record Hostinger settings such as PHP version, cron jobs, redirects, environment variables, email/DNS configuration, and deployment commands. Keep that material in a secure backup, not in GitHub.
