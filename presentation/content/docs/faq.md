---
title: "FAQ & Notes"
weight: 30
---

## Common Questions
- **Where is the API?** `http://localhost:8000/api` (or container port 8000).
- **Credentials?** `admin` / `Carlo` (seeded).
- **How to run locally?** `cd code && ./run.sh` (ensure MySQL is reachable).
- **How to run with Docker?** `cd code && ./setup.sh` (builds app+db, migrates/seeds).
- **Tests?** `code/tests/curl.sh` for end-to-end; `code/tests/tests.html` for manual.
- **Docs site?** Hugo at `https://tofuszn.github.io/ASE_Project2/`.

## Troubleshooting
- Sanctum token insert errors → ensure `personal_access_tokens` uses `ulidMorphs`.
- DB connection errors → confirm MySQL is running and `.env` matches host/port.
- Pages links broken → verify `baseURL` in `presentation/config.toml` and rerun workflow.
- Docker build PHP version mismatch → Dockerfile uses PHP 8.4 to match composer.lock.

## Deliverables Recap
- Laravel API (Project 2) with Sanctum.
- Docker stack + one-command scripts.
- Hugo docs (Project 1 + Project 2) with portfolio and screenshots.
- GitHub Actions → GitHub Pages deployment.
