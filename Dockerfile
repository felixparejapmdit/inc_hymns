# Stage 1: Frontend build
FROM node:20-alpine as frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP Application
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install system dependencies and PHP build requirements
RUN set -eux; \
    apk_retry() { \
        attempt=1; \
        max_attempts=5; \
        delay=2; \
        while ! "$@"; do \
            if [ "$attempt" -ge "$max_attempts" ]; then \
                return 1; \
            fi; \
            sleep "$delay"; \
            attempt=$((attempt + 1)); \
            delay=$((delay * 2)); \
        done; \
    }; \
    apk_retry apk add --no-cache \
        curl \
        git \
        mysql-client \
        freetype \
        libjpeg-turbo \
        oniguruma \
        libpng \
        libxml2 \
        libzip \
        unzip \
        zip; \
    apk_retry apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev \
        linux-headers \
        oniguruma-dev; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" pdo_mysql mbstring exif pcntl bcmath gd zip; \
    apk del .build-deps

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer.json/lock first for caching
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-scripts --no-autoloader --no-dev

# Copy existing application directory contents
COPY . /var/www

# Copy built frontend assets from stage 1
COPY --from=frontend-builder /app/public/build /var/www/public/build

# Remove bootstrap cache files to prevent loading old/dev providers
RUN rm -f bootstrap/cache/*.php

# Finish composer install
RUN composer dump-autoload --optimize --no-dev


# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
