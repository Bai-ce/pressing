#!/bin/bash

# Attendre la base de données
echo "Waiting for database..."
sleep 5

# Exécuter les migrations
echo "Running migrations..."
php artisan migrate --force

# Cache les configurations
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer Apache
echo "Starting Apache..."
exec apache2-foreground
