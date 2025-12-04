---
marp: true
title: "Projects"
weight: 4
---

## Project 1 – PHP Dealership API
- Plain PHP + PDO, custom token auth.
- Endpoints: auth, cars CRUD, sales create/list.
- Assets: `curl.sh`, `tests.html`, `schema.sql`, `database.php`.
- Deployment: PHP built-in server for dev, NGINX for prod-style hosting.
- Evidence: browser tester + cURL flow screenshots in docs.

---

## Project 2 – Laravel Dealership API
- Laravel 12 + Sanctum; Eloquent models for cars/sales/users (ULID IDs).
- Protected routes for write operations; seeder creates admin + sample cars.
- Scripts: `run.sh` (local), `setup.sh` + Docker stack.
- Tests: `code/tests/curl.sh`, `code/tests/tests.html`.
- Evidence: setup.sh success, browser tester, cURL flow (see docs).

---

## Documentation & Deployment
- Hugo site (this site) under `presentation/`.
- GitHub Actions workflow for GitHub Pages deployment.
- Marp slide decks for both projects under `/marp/`.
- BaseURL set to GitHub Pages: `https://tofuszn.github.io/ASE_Project2/`.

---

## Skills Demonstrated
- REST API design, authentication, ORM modeling.
- Dockerization, one-command deploy scripts.
- Static site generation and CI/CD for docs.
- GitHub Actions automation for Pages and reproducible builds.

---

## Deep Dive – Project 1 (PHP)
- Auth flow with random token persisted in `staff` table.
- Cars: CRUD with prepared statements; public GET, token-protected writes.
- Sales: records sale and marks car as sold.
- Testing: `curl.sh` end-to-end + `tests.html` for manual validation.
- Deployment: MySQL via Homebrew, PHP dev server, NGINX option.

---

## Deep Dive – Project 2 (Laravel)
- Auth: Sanctum bearer tokens; ULID users; `auth:sanctum` on write routes.
- Models: `User`, `Car`, `Sale` with Eloquent relationships.
- Migrations: cars, sales, users, personal_access_tokens (ULID morphs).
- Scripts: `run.sh` for local, `setup.sh` for Docker (app + MySQL).
- Tests: `curl.sh` scripted flow; `tests.html` manual prompts.
- Docs: Hugo with custom layouts; Actions deploy to Pages.

---

## Dev Workflow
- Local: `./run.sh` → migrate/seed → `php artisan serve` on :8000.
- Docker: `./setup.sh` → build app+db → migrate/seed → API on :8000.
- Verify: `code/tests/curl.sh` or open `code/tests/tests.html`.
- Docs: `cd presentation && hugo --minify`; push to trigger Pages.

---

## Links (quick access)
- Project 1 docs: `/docs/project1/`
- Project 2 docs: `/docs/project2/`
- Marp slides: `/marp/project1.marp.md`, `/marp/project2.marp.md`
- Portfolio (this page): `/portfolio/`

---

## Future Enhancements
- Add pagination/filters to `/api/cars`.
- Add OpenAPI/Swagger spec.
- Add PHPUnit coverage for controllers and CI test runs.
- Expand portfolio with more screenshots and live demo links.
