---
title: "Project 1 – PHP Dealership API"
weight: 10
---

# ASE230 Project 1 – Dealership REST API

## Overview
- PHP / MySQL / NGINX deployment
- Plain PHP 8.2 + PDO (no framework)
- JSON requests/responses; bearer token for write operations

## Presentation Roadmap
- Project objective & architecture
- Authentication design
- API catalogue with request/response samples
- Testing strategy and evidence
- Deployment to NGINX
- Operational refinements & next steps

## Technology Stack
- PHP 8.2 with PDO (no framework dependencies)
- MySQL 8 (Homebrew-managed service)
- JSON payloads for all requests/responses
- Bearer token authorization for state-changing endpoints
- Tooling: `curl.sh`, `tests.html`, `schema.sql`

## API Catalogue
1. `POST /api.php?resource=auth` — Authenticate & issue token  
2. `GET /api.php?resource=cars` — Retrieve inventory  
3. `GET /api.php?resource=cars&id={id}` — Retrieve specific vehicle  
4. `POST /api.php?resource=cars` — Create vehicle *(token required)*  
5. `PUT /api.php?resource=cars&id={id}` — Update vehicle *(token required)*  
6. `DELETE /api.php?resource=cars&id={id}` — Remove vehicle *(token required)*  
7. `GET /api.php?resource=sales` — List recorded sales  
8. `POST /api.php?resource=sales` — Record sale *(token required)*  

## Environment Setup
- Start database: `brew services start mysql`
- Provision schema: `mysql -u root -p < code/schema.sql`
- Admin credentials: username `admin`, password `Carlo`
- Launch dev API: `php -S localhost:3000 -t code`
- Verify readiness: `GET http://localhost:3000/api.php`

## Database Schema
- `cars`: `id`, `make`, `model`, `year`, `price`, `status`
- `sales`: `id`, `car_id`, `customer_name`, `sale_price`, `date`
- `staff`: `id`, `username`, `password_hash`, `role`, `token`
- Foreign key: `sales.car_id → cars.id (ON DELETE CASCADE)`

## Authentication Flow
1. Client submits credentials to `POST /api.php?resource=auth`
2. Server retrieves salted hash from `staff` and validates password
3. Token generated via `random_bytes(32)` and persisted on staff record
4. Response returns `{"token": "<64 hex characters>"}`
5. Protected requests include `Authorization: Bearer <token>`

### Authentication Example
Request:
```http
POST /api.php?resource=auth
Content-Type: application/json

{
  "username": "admin",
  "password": "Carlo"
}
```
Response `200 OK`:
```json
{ "token": "f5b4c8e7..." }
```

## Cars Endpoints
- `GET /api.php?resource=cars` — List all (public)
- `GET /api.php?resource=cars&id={id}` — Get one (public)
- `POST /api.php?resource=cars` — Create (auth)
- `PUT /api.php?resource=cars&id={id}` — Update (auth)
- `DELETE /api.php?resource=cars&id={id}` — Delete (auth)

Example list response:
```json
[{"id":1,"make":"Toyota","model":"Supra","year":2021,
  "price":"55000.00","status":"available"}]
```

## Sales Endpoint
- `GET /api.php?resource=sales` — List recorded sales (public)  
- `POST /api.php?resource=sales` — Record sale (auth)  

Example payload:
```json
{
  "car_id": 1,
  "customer_name": "Jane Doe",
  "sale_price": 53500
}
```
Creates a sale, marks the car as `sold`, returns the sale ID.

## Testing & Evidence
- `curl.sh` covers login, CRUD cars, record sale, delete, and verifies responses.
- `tests.html` browser harness for manual exercise of auth/cars/sales.
- JSON-only responses with proper status codes (200/201/400/401/403/404/405).

## Deployment
- Homebrew MySQL service for dev
- PHP built-in server for local testing (`php -S localhost:3000 -t code`)
- NGINX deployment for production-style hosting
- Ensure `.sql` schema is loaded and admin credentials set before start
