# 1️⃣ Početna PHP slika
FROM php:8.2-fpm

# 2️⃣ Instalacija sistema i PHP ekstenzija
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip libonig-dev libxml2-dev \
    nodejs npm \
 && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath tokenizer xml ctype

# 3️⃣ Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4️⃣ Radni direktorijum
WORKDIR /app
COPY . .

# 5️⃣ Instalacija PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# 6️⃣ Laravel APP_KEY
RUN cp .env.example .env
RUN php artisan key:generate

# 7️⃣ Build frontend (Tailwind + jQuery)
RUN npm install
RUN npm run build

# 8️⃣ Start Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
