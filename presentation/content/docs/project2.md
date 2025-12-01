---
title: "Project 2 – Laravel, Docker, Hugo"
weight: 20
weight: 2
---

## Goals

- Re-implement Project 1 API using Laravel 12 + Sanctum
- Use Eloquent ORM (no raw SQL)
- Provide one-command deploy scripts and Docker stack
- Document with Hugo and publish via GitHub Pages/Actions

## Laravel API (module 2)

Endpoints:

- `POST /api/auth/login` → bearer token
- `GET /api/cars`, `GET /api/cars/{id}`
- `POST /api/cars` (auth), `PUT /api/cars/{id}` (auth), `DELETE /api/cars/{id}` (auth)
- `GET /api/sales`, `POST /api/sales` (auth)

Data:

- Models: `User` (ULID IDs, Sanctum), `Car`, `Sale`
- Migrations: cars, sales, users, personal access tokens
- Seeder: admin user (`admin` / `Carlo`) and sample cars

Auth:

- Laravel Sanctum (`HasApiTokens`, `auth:sanctum` middleware on protected routes)

## Deployment Scripts

- Local: `code/run.sh` (composer install, key:generate, migrate --seed, serve)
- Docker: `code/setup.sh` (builds app + MySQL, runs migrate --seed)
- Docker assets: `code/Dockerfile`, `code/docker-compose.yml`

## Testing Aids

- `code/tests/curl.sh` full flow
- `code/tests/tests.html` prompt-based browser tester

## Hugo Docs & Pages (module 3)

- Hugo site lives in `presentation/`
- Custom layouts (no external theme) under `presentation/layouts/`
- Content: Project 1/2 docs + portfolio pages
- GitHub Actions workflow publishes Hugo output to GitHub Pages

## Next Steps / Setup

1. Set `baseURL` in `presentation/config.toml` to your GitHub Pages URL.
2. Build locally: `cd presentation && hugo` (install Hugo if needed).
3. Deploy automatically: push to GitHub with the provided workflow.
