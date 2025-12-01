#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT"

docker compose up -d --build

echo "Waiting for database to be ready..."
until docker compose exec -T db mysqladmin ping -h"db" -uroot -prootpassword --silent; do
  sleep 2
done

echo "Running migrations and seeds inside the container..."
docker compose exec app php artisan migrate --force --seed

echo "API available at http://localhost:8000/api"
