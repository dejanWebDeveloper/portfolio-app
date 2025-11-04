FROM php:8.3-fpm

# Sistemske zavisnosti i PHP ekstenzije
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath xml ctype gd exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer globalno
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Laravel dependencies i frontend
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build

# Storage i permisije
RUN rm -f public/storage \
    && php artisan storage:link \
    && chown -R www-data:www-data storage bootstrap/cache public/storage \
    && chmod -R 775 storage bootstrap/cache public/storage

# Očisti keš
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
