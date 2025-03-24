# Utiliser l'image officielle de PHP avec Apache
FROM php:8.2.0-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Activer les modules Apache
RUN a2enmod rewrite

# Copier le code source de Symfony dans le container
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer Composer pour gérer les dépendances de Symfony
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Installer les dépendances Symfony avec Composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 8000 pour Symfony
EXPOSE 8000
