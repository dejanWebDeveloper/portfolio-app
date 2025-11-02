# 1. PHP image
FROM php:8.2-cli

# 2. Instalacija sistema i PHP ekstenzija
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip libonig-dev libxml2-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath tokenizer xml ctype

# 3. Instalacija Composer-a
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Setovanje radnog direktorijuma
WORKDIR /app

# 5. Kopiranje projekta
COPY . .

# 6. Instalacija PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# 7. Generisanje APP_KEY
RUN php artisan key:generate

# 8. Frontend build (Tailwind + jQuery)
RUN npm install && npm run build

# 9. Expose port
EXPOSE 8000

# 🔟 Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
