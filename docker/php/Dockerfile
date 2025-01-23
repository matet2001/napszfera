# Use a specific version of php:8.2-fpm-alpine for consistency
FROM php:8.2.0-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Switch to root for installing system dependencies
USER root

# Install system dependencies required for installing PHP extensions, git, and other utilities
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
    mysql-client \
    git \
    shadow

# Ensure 'www' group exists and modify it
RUN if ! getent group www; then \
        addgroup -g ${GID:-1000} www; \
    fi && \
    if ! id www > /dev/null 2>&1; then \
        adduser -D -u ${UID:-1000} -G www www; \
    fi && \
    groupmod -g ${GID:-1000} www && \
    usermod -u ${UID:-1000} -g ${GID:-1000} www

# Install PHP extensions required by Laravel and other common needs
RUN docker-php-ext-install pdo_mysql zip exif pcntl gd mbstring

# Install Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Switch to the non-root user dynamically
USER ${UID:-1000}:${GID:-1000}

# Copy your Laravel project into the container
COPY . /var/www/html

# Specify the command to run
CMD ["php-fpm"]
