FROM php:8.4-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Copier Composer depuis l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de dépendances
COPY composer.json composer.lock ./
COPY package*.json ./

# Installer les dépendances PHP (sans scripts et autoloader pour l'instant)
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Installer les dépendances Node.js
RUN npm install

# Copier tous les fichiers de l'application
COPY . .

# S'assurer que le .htaccess est présent dans public
COPY .htaccess public/.htaccess 2>/dev/null || true

# Générer l'autoloader optimisé
RUN composer dump-autoload --optimize --no-dev

# Build des assets avec Vite
RUN npm run build

# Nettoyer node_modules pour réduire la taille de l'image
RUN rm -rf node_modules

# Créer les répertoires nécessaires et définir les permissions
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Configurer Apache pour écouter sur le port 8080
RUN sed -i 's/Listen 80/Listen 8080/g' /etc/apache2/ports.conf

# Activer les modules Apache nécessaires
RUN a2enmod rewrite

# Copier la configuration Apache
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copier le script de démarrage
COPY docker/start.sh /usr/local/bin/start.sh

# Rendre le script exécutable
RUN chmod +x /usr/local/bin/start.sh

# Exposer le port 8080
EXPOSE 8080

# Commande de démarrage
CMD ["/usr/local/bin/start.sh"]
