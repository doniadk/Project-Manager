# Stage 1: PHP with Apache
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

# Ensure app_local.php exists to avoid post-install errors
RUN if [ -f config/app_local.example.php ]; then \
        cp config/app_local.example.php config/app_local.php; \
    else \
        echo "Warning: app_local.example.php not found. Skipping copy."; \
    fi

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for tmp/logs
RUN chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Expose Apache port
EXPOSE 80

# Pre-deploy: run migrations if present
# This assumes you have bin/post-deploy.sh in your repo
RUN if [ -f bin/post-deploy.sh ]; then \
        chmod +x bin/post-deploy.sh && bin/post-deploy.sh; \
    else \
        echo "No post-deploy.sh found. Skipping migrations."; \
    fi

# Start Apache
CMD ["apache2-foreground"]
