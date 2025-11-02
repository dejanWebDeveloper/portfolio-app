# 1️⃣ Bazni PHP image
FROM php:8.2-cli

# 2️⃣ Instalacija sistemskih paketa i zavisnosti
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    curl \
    zip \
    libonig-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath

# 3️⃣ Instalacija Composer-a
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4️⃣ Setovanje radnog direktorijuma
WORKDIR /app

# 5️⃣ Kopiranje celog projekta
COPY . .

# 6️⃣ Instalacija PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# 7️⃣ Generisanje APP_KEY
RUN php artisan key:generate

# 8️⃣ Instalacija frontend zavisnosti (Tailwind + jQuery)
RUN npm install && npm run build

# 9️⃣ Otvoreni port
EXPOSE 8000

# 🔟 Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
