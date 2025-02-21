# Usar la imagen oficial de PHP con FPM
FROM php:8.3-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmariadb-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Copiar el binario de Composer desde la imagen oficial de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Cambiar permisos para el usuario web
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto para PHP-FPM (opcional, depende de tu setup)
EXPOSE 9000

# Comando por defecto al iniciar el contenedor
CMD ["php-fpm"]
