---
title: "Project 1 – PHP Dealership API"
weight: 1
---

## Overview

Project 1 delivered a plain PHP dealership REST API using PDO, JWT-like tokens, and a MySQL schema for `cars`, `sales`, and `staff`.

## Endpoints (Project 1)

- `POST ?resource=auth` – login with username/password, returns token
- `GET|POST|PUT|DELETE ?resource=cars[&id]`
- `GET|POST ?resource=sales`

## Database Schema

- `cars(id, make, model, year, price, status)`
- `sales(id, car_id, customer_name, sale_price, date)`
- `staff(id, username, password_hash, role, token)`

## Testing Aids (Project 1)

- `curl.sh` to run the full flow (login, CRUD, sales)
- `tests.html` browser harness to exercise endpoints
- `schema.sql` and `database.php` for setup and helpers
