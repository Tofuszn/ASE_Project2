---
marp: true
title: ASE230 Project 2 – Laravel/Docker/Hugo
paginate: true
---

# ASE230 Project 2
## Laravel REST API + Docker + Hugo
Carlo Calipo

---

# Objectives
- Re-implement Project 1 API in Laravel 12
- Use Eloquent (no raw SQL) + Sanctum auth
- One-command deploy scripts & Docker stack
- Hugo docs + GitHub Pages (CI/CD)

---

# Architecture
- Laravel 12 + Sanctum
- MySQL 8 (Docker)
- Eloquent models: User (ULID), Car, Sale
- Protected routes for write operations

---

# API Endpoints
- `POST /api/auth/login`
- `GET /api/cars`, `GET /api/cars/{id}`
- `POST /api/cars` (auth)
- `PUT /api/cars/{id}` (auth)
- `DELETE /api/cars/{id}` (auth)
- `GET /api/sales`
- `POST /api/sales` (auth)

---

# Data Model
- `users` (ULID, role, password)
- `cars` (make, model, year, price, status)
- `sales` (car_id, customer_name, sale_price)
- Sanctum `personal_access_tokens`

---

# Auth Flow (Sanctum)
1. `POST /api/auth/login` with username/password
2. Verify password hash
3. Issue Sanctum token
4. Bearer token required for POST/PUT/DELETE

---

# Scripts
- Local: `code/run.sh` (install, key:generate, migrate --seed, serve)
- Docker: `code/setup.sh` (build, start MySQL+app, migrate --seed)
- Tests: `code/tests/curl.sh`, `code/tests/tests.html`

---

# Docker Stack
- `Dockerfile` (PHP 8.4-cli, composer, artisan setup)
- `docker-compose.yml` (app + MySQL 8)
- Exposes API on `localhost:8000`

---

# Evidence – setup.sh
![w:780](../images/setupSS.png)

---

# Evidence – cURL Flow
![w:780](../images/curlTestSS.png)

---

# Evidence – Browser Tester
![w:780](../images/htmlTestSS.png)

---

# Hugo Docs
- Content under `presentation/content`
- Custom layouts (no external theme)
- Published via GitHub Actions → GitHub Pages

---

# GitHub Actions (Pages)
- Workflow builds Hugo (`presentation/`) on push to main
- Deploys to `https://tofuszn.github.io/ASE_Project2/`
- Uses built-in `deploy-pages` action

---

# Testing Strategy
- `curl.sh` covers login, CRUD cars, sale, delete
- `tests.html` for manual browser validation
- Seeded admin: `admin` / `Carlo`

---

# Lessons Learned
- ULID IDs and Sanctum tokens required tokenable morph changes
- Docker PHP version must match composer lock (8.4)
- Relative vs. canonical URLs for Pages subpath

---

# Next Steps
- Add pagination/filters to cars
- Add CI tests (PHPUnit) for controllers
- Add swagger/OpenAPI docs
