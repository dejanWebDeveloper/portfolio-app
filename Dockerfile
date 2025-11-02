# 1. PHP base image
FROM php:8.2-cli

# 2. Instalacija sistema i PHP ekstenzija
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    curl \
    zip \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath tokenizer xml ctype

# 3. Instalacija Node.js (za Tailwind)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 4. Instalacija Composer-a
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5. Radni direktorijum
WORKDIR /app

# 6. Kopiranje projekta
COPY . .

# 7. Instalacija PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# 8. Generisanje APP_KEY
RUN php artisan key:generate

# 9. Frontend build (Tailwind + jQuery)
RUN npm install && npm run build

# 🔟 Otvoreni port
EXPOSE 8000

# 1️⃣1️⃣ Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
