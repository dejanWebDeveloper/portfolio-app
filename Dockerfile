# 1️⃣ PHP base image
FROM php:8.2-cli

# 2️⃣ Instalacija sistema i PHP build alata
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    build-essential \
    pkg-config \
    libpng-dev \
    zlib1g-dev \
    libsqlite3-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 3️⃣ Instalacija PHP ekstenzija
RUN docker-php-ext-install pdo pdo_pgsql zip mbstring bcmath tokenizer xml ctype

# 4️⃣ Instalacija Node.js (za Tailwind)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 5️⃣ Instalacija Composer-a
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 6️⃣ Setovanje radnog direktorijuma
WORKDIR /app

# 7️⃣ Kopiranje projekta
COPY . .

# 8️⃣ Instalacija PHP zavisnosti
RUN composer install --no-dev --optimize-autoloader

# 9️⃣ Generisanje APP_KEY
RUN php artisan key:generate

# 🔟 Frontend build (Tailwind + jQuery)
RUN npm install && npm run build

# 1️⃣1️⃣ Otvaranje porta
EXPOSE 8000

# 1️⃣2️⃣ Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
