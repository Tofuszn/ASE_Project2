# Laravel Dealership API (Project 2)

Laravel 12 REST API that re-implements the Project 1 dealership endpoints with Sanctum authentication, Docker, and one-command scripts.

## Quick start (local)

```bash
cd code
./run.sh          # installs deps, migrates + seeds, serves on http://localhost:8000
```

Ensure MySQL is running and matches `.env` (default: host `db`, db `dealership`, user `dealership_user`, pass `dealership_pass`). For localhost MySQL, set `DB_HOST=127.0.0.1` before running.

## Quick start (Docker)

```bash
cd code
./setup.sh        # build containers, run migrations + seeds
```

`http://localhost:8000/api` will expose the API, backed by a MySQL 8 container.

## API credentials

- Username: `admin`
- Password: `Carlo`

## Endpoints

- `POST /api/auth/login` → bearer token (Sanctum)
- `GET /api/cars` → list cars
- `GET /api/cars/{id}` → car details
- `POST /api/cars` → create car _(auth)_
- `PUT /api/cars/{id}` → update car _(auth)_
- `DELETE /api/cars/{id}` → delete car _(auth)_
- `GET /api/sales` → list sales
- `POST /api/sales` → record sale, marks car sold _(auth)_

## Testing helpers

- `tests/curl.sh` runs the full flow from login through sale.
- `tests/tests.html` browser harness to exercise endpoints quickly.
