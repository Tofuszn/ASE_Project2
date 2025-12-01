---
title: "Project 2 – Laravel, Docker, Hugo"
weight: 20
---

# ASE230 Project 2 – Laravel REST API + Docker + Hugo

## Overview
- Re-implemented the Project 1 dealership API using Laravel 12 + Sanctum.
- Eloquent-only data layer; no raw SQL.
- Docker stack with one-command scripts for app + MySQL.
- Hugo documentation + GitHub Pages auto-deploy via Actions.

## Goals & Outcomes
- **API parity** with Project 1 plus Laravel best practices.
- **Auth**: Sanctum bearer tokens for all write operations.
- **Data**: ULID users; cars/sales tables with relationships.
- **Ops**: One-command local runner + Docker setup script.
- **Docs**: Hugo site with screenshots and evidence.
- **CI/CD**: GitHub Actions builds docs and publishes to Pages.

## Architecture
- Laravel 12 (PHP 8.4) with Sanctum.
- MySQL 8 (Docker service).
- Eloquent models: `User`, `Car`, `Sale`.
- Routes under `/api/*` with `auth:sanctum` for write paths.
- Seeded admin user: `admin` / `Carlo`.

## API Catalogue
- `POST /api/auth/login` — Issue bearer token.  
- `GET /api/cars` — List cars.  
- `GET /api/cars/{id}` — Get car details.  
- `POST /api/cars` — Create car (auth).  
- `PUT /api/cars/{id}` — Update car (auth).  
- `DELETE /api/cars/{id}` — Delete car (auth).  
- `GET /api/sales` — List sales.  
- `POST /api/sales` — Record sale (auth).  

## Auth Flow (Sanctum)
1. Client posts credentials to `/api/auth/login`.
2. Password hash verified; Sanctum token created.
3. Token returned; subsequent writes require `Authorization: Bearer <token>`.
4. `auth:sanctum` middleware protects POST/PUT/DELETE routes.

## Data Model
- **users**: ULID id, username, role, password (hashed).  
- **cars**: make, model, year, price, status (`available|sold`).  
- **sales**: car_id, customer_name, sale_price, timestamps.  
- **personal_access_tokens**: Sanctum tokens with ULID morphs.  
- Relationships: User has tokens; Car has many Sales; Sale belongs to Car.

## Migrations & Seeders
- Migrations create users, cars, sales, Sanctum tokens.
- Seeder:
  - Admin user (`admin` / `Carlo`).
  - Sample cars (Supra, Mustang).
- Idempotent seeding (updateOrCreate / firstOrCreate).

## Deployment Scripts
- **Local:** `code/run.sh`
  - composer install, `php artisan key:generate`, migrate --seed, serve on :8000.
- **Docker:** `code/setup.sh`
  - Builds app + MySQL, waits for DB, migrate --seed.
- **Compose:** `code/docker-compose.yml` (app + MySQL), `code/Dockerfile` (PHP 8.4).

## Testing Aids
- `code/tests/curl.sh` — full flow: login → CRUD cars → sale → delete.
- `code/tests/tests.html` — prompt-based browser harness for manual checks.

## Evidence (Screenshots)
{{< figure src="/images/setupSS.png" alt="setup.sh success" >}}

{{< figure src="/images/htmlTestSS.png" alt="Browser tester output" >}}

{{< figure src="/images/curlTestSS.png" alt="cURL flow output" >}}

## Configuration Notes
- `.env` set for MySQL host `db` (Docker) or `127.0.0.1` locally.
- Sanctum guard added; ULID morph for tokens to avoid truncation.
- CORS enabled for `/api/*`.

## Lessons Learned
- Composer lock demanded PHP 8.4 in Docker to match deps.
- Sanctum + ULID requires `ulidMorphs` on `personal_access_tokens`.
- Canonical URLs for GitHub Pages subpath to fix link issues.
- Seeders should be idempotent to avoid duplicate admin errors.

## Troubleshooting
- **Auth 500 + tokenable_id truncation**: use `ulidMorphs` in tokens migration.
- **Pages links doubled path**: set `baseURL` and use canonical URLs; adjust menu links.
- **Docker compose DB not found**: ensure services running, rerun `setup.sh`.

## Detailed Endpoint Behaviors
- Cars POST/PUT validate make/model/year/price; status optional on update.
- Sales POST validates car exists; marks car as `sold` after sale creation.
- Deletes return `{deleted: true}` and 404 when re-fetching.

## Security Considerations
- Sanctum tokens only; no sessions/cookies.
- Bearer required for all write operations.
- Validation on inputs; 404/401/403 responses for bad states.

## Performance & Stability
- Simple query patterns via Eloquent.
- Seeded data for instant testing.
- Docker isolates app + DB; consistent local/dev environment.

## Documentation & Pages
- Hugo site under `presentation/` with custom layouts (no external theme).
- Docs for Project1/Project2, Portfolio, screenshots, links to tests.
- GitHub Actions (`.github/workflows/gh-pages.yml`) builds Hugo and deploys to Pages.

## How to Run (Local)
```
cd code
./run.sh
```
Hit `http://localhost:8000/api` and use `curl.sh` or `tests.html`.

## How to Run (Docker)
```
cd code
./setup.sh
```
App on `http://localhost:8000/api`. Credentials: `admin` / `Carlo`.

## Testing Flow (Sample)
1) Login → token  
2) Create car (auth)  
3) Update price (auth)  
4) Record sale (auth)  
5) List sales  
6) Delete car (auth) → 404 on fetch  

## Evidence Narrative
- **setup.sh**: shows successful build, migrate, seed with app+db containers.
- **Browser tester**: manual buttons for auth/cars/sales returning JSON.
- **cURL flow**: scripted end-to-end outputs confirming CRUD + sale.

## Future Enhancements
- Add pagination and filters to `/api/cars`.
- Add OpenAPI/Swagger documentation.
- Add PHPUnit feature tests for controllers.
- Add CI to run tests on push.

## Key Files Reference
- Routes: `code/backend/routes/api.php`
- Controllers: `AuthController`, `CarController`, `SaleController`
- Models: `User` (ULID, HasApiTokens), `Car`, `Sale`
- Migrations: users, cars, sales, personal_access_tokens (ULID morph)
- Seeders: `DatabaseSeeder` (admin + sample cars)
- Scripts: `run.sh`, `setup.sh`
- Tests: `code/tests/curl.sh`, `code/tests/tests.html`

## Quick FAQ
- **Why ULID?** Stable, sortable identifiers; needed ULID morph for Sanctum.
- **Why PHP 8.4 in Docker?** Composer lock pinned Symfony 8 packages requiring 8.4.
- **DB errors on tokenable_id?** Use `ulidMorphs` in Sanctum tokens migration.

## Summary
Project 2 delivers a Laravel-based dealership API with Sanctum auth, Dockerized deployment, one-command scripts, comprehensive tests, and a Hugo site published via GitHub Pages, fully re-implementing Project 1 with modern tooling and CI/CD.
