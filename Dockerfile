FROM php:8.3-fpm

ENV DB_CONNECTION=pgsql

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev  # Adicionado para suporte ao PostgreSQL

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd sockets

# Instalação do Composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
 	&& php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer

WORKDIR /application

EXPOSE 80