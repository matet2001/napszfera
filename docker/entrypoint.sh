#!/bin/sh

# Wait for MySQL to be ready
echo "Waiting for MySQL..."
until nc -z -v -w30 db 3306; do
  echo "Waiting for database connection..."
  sleep 5
done

# Run migrations with seeding
echo "Running migrations..."
php artisan migrate --force --seed

# Start PHP-FPM
php-fpm
