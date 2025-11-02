# 1️⃣ Base image PHP 8.3 CLI
FROM php:8.3-cli

# 2️⃣ Instalacija sistema i build alata
RUN apt-get update && apt-get install -y \
    git unzip curl zip libonig-dev libxml2-dev libzip-dev libpq-dev \
    build-essential pkg-config libpng-dev zlib1g-dev libjpeg-dev libfreetype6-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3️⃣ Instalacija PHP ekstenzija
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath xml gd exif

# 4️⃣ Node.js 20 za Tailwind
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 5️⃣ Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 6️⃣ Radni direktorijum
WORKDIR /app

# 7️⃣ Kopiranje projekta
COPY . .

# 8️⃣ Kopiranje .env.example kao .env da key:generate radi
COPY .env.example .env

# 9️⃣ PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# 🔑 Laravel APP_KEY
RUN php artisan key:generate

# 🔧 Frontend build (Tailwind + jQuery)
RUN npm install && npm run build

# 1️⃣0️⃣ Otvaranje porta
EXPOSE 8000

# 1️⃣1️⃣ Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
