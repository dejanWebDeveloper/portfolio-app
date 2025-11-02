# 1️⃣ Base image - PHP 8.3 FPM
FROM php:8.3-fpm

# 2️⃣ Instalacija sistema i PHP ekstenzija
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath tokenizer xml ctype gd exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3️⃣ Set radni direktorij
WORKDIR /app

# 4️⃣ Kopiranje composer datoteka i instalacija PHP zavisnosti
COPY composer.lock composer.json ./
RUN composer install --no-dev --optimize-autoloader

# 5️⃣ Kopiranje ostatka aplikacije
COPY . .

# 6️⃣ Generisanje APP_KEY (samo ako .env postoji)
RUN if [ -f .env ]; then php artisan key:generate; fi

# 7️⃣ Instalacija Node zavisnosti i build frontenda
RUN npm install && npm run build

# 8️⃣ Expose port i start komande
EXPOSE 9000
CMD ["php-fpm"]
