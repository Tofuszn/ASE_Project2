FROM php:8.4-cli

RUN apt-get update \
  && apt-get install -y git unzip libzip-dev libicu-dev libonig-dev libxml2-dev \
  && docker-php-ext-install pdo_mysql intl zip \
  && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY backend/composer.json ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-progress || true

COPY backend ./

RUN cp .env.example .env \
  && composer install --no-dev --no-interaction --prefer-dist --no-progress \
  && php artisan key:generate --ansi \
  && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
