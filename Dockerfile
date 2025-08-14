FROM php:8.2-fpm

# Installer dépendances système et extensions PHP nécessaires à Laravel
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Configurer le répertoire de travail
WORKDIR /var/www
