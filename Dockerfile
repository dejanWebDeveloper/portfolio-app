# 1️⃣ Base PHP image
FROM php:8.2-fpm

# 2️⃣ Instalacija sistema i PHP ekstenzija
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    curl \
    zip \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
 && docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath xml ctype \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3️⃣ Instalacija Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4️⃣ Postavi radni direktorijum
WORKDIR /app

# 5️⃣ Kopiraj ceo kod
COPY . .

# 6️⃣ Instalacija PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# 7️⃣ Generisanje APP_KEY
# Render automatski generiše APP_KEY, možeš da preskočiš ovo
# RUN php artisan key:generate

# 8️⃣ Build frontenda (Tailwind + jQuery)
RUN npm install && npm run build

# 9️⃣ Expose port
EXPOSE 8000

# 🔟 Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
