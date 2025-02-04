# Use official PHP image with necessary extensions
FROM php:8.2-fpm AS php

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    netcat-openbsd \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and NPM
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && apt-get install -y nodejs

# Set working directory
WORKDIR /var/www

# Copy Laravel files
COPY . .

# Ensure necessary directories exist
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache

# Set correct permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install NPM dependencies and build assets
RUN npm install && npm run build

# --- Separate stage for serving built assets ---
FROM nginx:latest AS nginx

# Copy built assets from the PHP stage
COPY --from=php /var/www/public/build /usr/share/nginx/html/build

# Copy Laravel public folder (except build folder)
COPY --from=php /var/www/public /var/www/public

# Copy Nginx configuration
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
