FROM php:8.2-fpm

# Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_mysql zip gd \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Definir directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar todo el backend al contenedor
COPY backend ./

# Instalar dependencias PHP desde backend/composer.json
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist
