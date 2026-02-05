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

# Configurer le port Apache
sed -i 's/Listen 80/Listen 8080/g' /etc/apache2/ports.conf
sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

# Démarrer Apache
echo "Starting Apache..."
apache2-foreground
