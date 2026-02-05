#!/bin/bash

echo "Waiting for database..."
sleep 5

echo "Running migrations..."

php artisan migrate:fresh --seed --force

echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting Apache..."
apache2-foreground
