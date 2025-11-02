# 1️⃣ PHP base image
FROM php:8.2-cli

# 2️⃣ Instalacija osnovnih sistema paketa
RUN apt-get update \
    && apt-get install -y git unzip curl zip libonig-dev libxml2-dev libzip-dev libpq-dev \
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
COPY --from=composer:2 /usr/bin/composer /usr/bi
