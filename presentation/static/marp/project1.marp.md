---
marp: true
title: ASE230 Project 1 – Dealership API
paginate: true
---

# ASE230 Project 1
## PHP Dealership REST API
Carlo Calipo

---

# Objectives
- Build a REST API with plain PHP 8.2 + PDO
- Secure write operations with bearer tokens
- Persist cars, sales, staff in MySQL
- Provide cURL + HTML test harnesses

---

# Architecture
- PHP 8.2 + PDO (no framework)
- MySQL 8 (Homebrew service)
- JSON requests/responses
- Bearer token for POST/PUT/DELETE
- NGINX for prod-style hosting

---

# API Catalogue
1. `POST /api.php?resource=auth`
2. `GET /api.php?resource=cars`
3. `GET /api.php?resource=cars&id={id}`
4. `POST /api.php?resource=cars`
5. `PUT /api.php?resource=cars&id={id}`
6. `DELETE /api.php?resource=cars&id={id}`
7. `GET /api.php?resource=sales`
8. `POST /api.php?resource=sales`

---

# Authentication Flow
1. User posts credentials to `/auth`
2. Lookup salted hash in `staff`
3. Generate 64-char token via `random_bytes`
4. Persist token; respond with bearer token
5. Protected routes require `Authorization: Bearer <token>`

---

# Data Model
- `cars`: id, make, model, year, price, status
- `sales`: id, car_id, customer_name, sale_price, date
- `staff`: id, username, password_hash, role, token
- FK: `sales.car_id -> cars.id (cascade delete)`

---

# Environment Setup
- `brew services start mysql`
- `mysql -u root -p < code/schema.sql`
- Admin: `admin` / `Carlo`
- Dev server: `php -S localhost:3000 -t code`
- Smoke test: `GET http://localhost:3000/api.php`

---

# Cars – List All
`GET /api.php?resource=cars`
```json
[{"id":1,"make":"Toyota","model":"Supra","year":2021,
  "price":"55000.00","status":"available"}]
```

---

# Cars – Create (secured)
`POST /api.php?resource=cars`
```json
{
  "make": "Toyota",
  "model": "Supra",
  "year": 2021,
  "price": 55000
}
```

---

# Sales – Record (secured)
`POST /api.php?resource=sales`
```json
{
  "car_id": 1,
  "customer_name": "Jane Doe",
  "sale_price": 53500
}
```
Marks car as `sold`, returns sale id.

---

# Testing Aids
- `curl.sh` full flow (auth → CRUD cars → sale → delete)
- `tests.html` browser harness
- JSON-only responses with proper status codes

---

# Evidence – HTML Tester
![w:780](../images/htmlTestSS.png)

---

# Evidence – cURL Flow
![w:780](../images/curlTestSS.png)

---

# Deployment
- Homebrew MySQL
- PHP built-in server for dev
- NGINX for production
- Ensure schema + admin credentials loaded before start

---

# Lessons Learned / Next Steps
- Solidify token handling and error codes
- Add pagination/filters to cars list
- Expand tests and CI
