#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
APP_DIR="${APP_DIR:-$ROOT/backend}"
APP_PORT="${APP_PORT:-8000}"

if [ ! -f "$APP_DIR/.env" ]; then
  cp "$APP_DIR/.env.example" "$APP_DIR/.env"
fi

cd "$APP_DIR"
composer install --no-interaction --prefer-dist
php artisan key:generate --ansi
php artisan migrate:fresh --force --seed
php artisan serve --host=0.0.0.0 --port="$APP_PORT"
