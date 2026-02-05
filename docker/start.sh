#!/bin/bash

# Attendre que la base de données soit prête (optionnel mais recommandé)
echo "Waiting for database..."
sleep 5

# Exécuter les migrations
echo "Running migrations..."
php artisan migrate --force

# Cache de configuration pour améliorer les performances
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer Apache
echo "Starting Apache..."
apache2-foreground
```

## 📝 Étape 4 : Créer `.dockerignore`

Créez un fichier `.dockerignore` à la racine :
```
.git
.github
.env
.env.*
node_modules
vendor
storage/logs/*
storage/framework/cache/*
storage/framework/sessions/*
storage/framework/views/*
bootstrap/cache/*
.phpunit.result.cache
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
.DS_Store
Thumbs.db
*.log
.vscode
.idea
```

## 📝 Étape 5 : Vérifier votre `.gitignore`

Assurez-vous que votre `.gitignore` contient :
```
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.phpunit.result.cache
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
.DS_Store
