# Gunakan PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project
COPY . .

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Generate Laravel cache config
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Expose port 8000
EXPOSE 8000

# Jalankan Laravel pakai artisan serve
CMD php artisan serve --host=0.0.0.0 --port=8000
