# 1. Koristimo PHP CLI sa potrebnim ekstenzijama
FROM php:8.2-cli

# 2. Instaliramo sistemske zavisnosti
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip

# 3. Instaliramo PHP ekstenzije
RUN docker-php-ext-install pdo pdo_pgsql zip

# 4. Instaliramo Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5. Setujemo radni direktorijum u container-u
WORKDIR /app

# 6. Kopiramo ceo projekat u container
COPY . .

# 7. Instaliramo PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# 8. Generišemo APP_KEY
RUN php artisan key:generate

# 9. Expose port koji će Laravel koristiti
EXPOSE 8000

# 10. Start komanda za Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
