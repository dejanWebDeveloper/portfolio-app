# 1️⃣ Baza — PHP sa Composer-om
FROM php:8.2-fpm

# 2️⃣ Instalacija sistema i PHP ekstenzija
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath xml ctype gd exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3️⃣ Instalacija Composer-a (globalno)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4️⃣ Kopiramo aplikaciju
WORKDIR /var/www/html
COPY . .

# 5️⃣ Instalacija Laravel dependencija
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 6️⃣ Build frontend-a (ako koristiš Vite)
RUN npm install && npm run build

# 7️⃣ Laravel permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8️⃣ Environment
ENV APP_ENV=production
ENV APP_DEBUG=false

# 9️⃣ Pokretanje PHP servera (Render automatski koristi port 10000)
EXPOSE 10000
CMD php artisan serve --host=0.0.0.0 --port=10000
