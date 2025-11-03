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

# 9️⃣ Expose port (Render koristi port iz $PORT promenljive)
EXPOSE 8000

# 🔟 Pokreni Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
