# Base image sa PHP 8.3
FROM php:8.3-cli

# Instalacija sistema i build alata
RUN apt-get update && apt-get install -y \
    git unzip curl zip libonig-dev libxml2-dev libzip-dev libpq-dev \
    build-essential pkg-config libpng-dev zlib1g-dev libsqlite3-dev libjpeg-dev libfreetype6-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# PHP ekstenzije: pdo_pgsql, mbstring, zip, xml, bcmath, gd, exif
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath xml gd exif

# Node.js za Tailwind
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Radni direktorijum
WORKDIR /app

# Kopiranje projekta
COPY . .

# PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# Laravel APP_KEY
RUN php artisan key:generate

# Frontend build (Tailwind + jQuery)
RUN npm install && npm run build

# Otvaranje porta
EXPOSE 8000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
