# 1️⃣ Osnovni image sa PHP 8.3 i FPM
FROM php:8.3-fpm

# 2️⃣ Instalacija sistemskih paketa i PHP ekstenzija
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath xml ctype gd exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3️⃣ Instaliraj Composer globalno
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4️⃣ Postavi radni direktorijum
WORKDIR /var/www/html

# 5️⃣ Kopiraj sve fajlove u kontejner
COPY . .

# 6️⃣ Instalacija Laravel dependencija
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 7️⃣ Build frontend-a (ako koristiš Vite)
RUN npm install && npm run build

# 8️⃣ Poveži storage folder sa public i postavi permisije
RUN rm -f public/storage \
    && php artisan storage:link \
    && chown -R www-data:www-data storage bootstrap/cache public/storage \
    && chmod -R 775 storage bootstrap/cache public/storage

# 9️⃣ Očisti Laravel keš i konfiguraciju
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear

# 🔟 Expose port (Render koristi port iz $PORT promenljive)
EXPOSE 8000

# 1️⃣1️⃣ Pokreni Laravel server
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
