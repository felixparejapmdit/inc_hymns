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

# Install system dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    libzip-dev \
    mysql-client \
    linux-headers \
    libjpeg-turbo-dev \
    freetype-dev

# Install and configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer.json/lock first for caching
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-scripts --no-autoloader --no-dev

# Copy existing application directory contents
COPY . /var/www

# Copy built frontend assets from stage 1
COPY --from=frontend-builder /app/public/build /var/www/public/build

# Finish composer install
RUN composer dump-autoload --optimize --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

