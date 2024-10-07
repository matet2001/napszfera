# Use a specific version of php:8.2-fpm-alpine for consistency
FROM php:8.2.0-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies required for installing PHP extensions and other utilities
RUN apk add --no-cache \
    libpng-dev \
    libzip-dev \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    unzip \
    curl \
    oniguruma-dev \
    libxml2-dev \
    mysql-client

# Install PHP extensions required by Laravel and other common needs
RUN docker-php-ext-install pdo_mysql zip exif pcntl gd mbstring

# Install Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy your Laravel project into the container
# Assuming your context is set correctly to the parent directory of your Laravel project
COPY . /var/www/html

# Correctly set permissions for the storage and bootstrap/cache directories
#RUN chmod -R 775 storage bootstrap/cache

# Specify non-root user for PHP-FPM process, enhancing security
# Note: You might need to adjust the user ID based on your host system or Kubernetes setup if you're using it
RUN addgroup -g 1000 www
RUN adduser -D -u 1000 -G www www
USER www

# Specify the command to run
CMD ["php-fpm"]
