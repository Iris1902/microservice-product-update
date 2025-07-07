# Dockerfile para microservicio Laravel API
FROM php:8.2-fpm

# Instala dependencias del sistema
RUN apt-get update \
    && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia los archivos de la aplicación
COPY . .

# Instala dependencias de PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Da permisos a la carpeta de almacenamiento y caché
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expone el puerto 8000
EXPOSE 6002

# Comando por defecto para iniciar el servidor
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=6002"]
