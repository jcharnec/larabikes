FROM php:8.2-apache

# Instala dependencias del sistema y extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    libpng-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring curl

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia el código fuente de Laravel dentro del contenedor
COPY . /var/www/html

# Define el directorio de trabajo
WORKDIR /var/www/html

# Ajusta los permisos de Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Ejecuta composer install
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto 80
EXPOSE 80
