# Base image: PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
        libonig-dev \
        libzip-dev \
        unzip \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libicu-dev \
        default-mysql-client \
    && docker-php-ext-configure mbstring \
    && docker-php-ext-install mbstring pdo pdo_mysql intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite (needed for CakePHP routing)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies without running post-install scripts
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Create tmp and logs directories and set permissions
RUN mkdir -p tmp logs \
    && chown -R www-data:www-data tmp logs \
    && chmod -R 775 tmp logs

# Make post-deploy script executable (do NOT run it during build)
RUN if [ -f bin/post-deploy.sh ]; then chmod +x bin/post-deploy.sh; fi

# Expose Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
