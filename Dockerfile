# Use PHP 8.3 with Apache
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies required for PHP extensions
RUN apt-get update && apt-get install -y \
        libonig-dev \
        libzip-dev \
        unzip \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libicu-dev \
        default-mysql-client \
        libxml2-dev \
    && docker-php-ext-configure mbstring \
    && docker-php-ext-configure intl \
    && docker-php-ext-install mbstring pdo pdo_mysql intl zip opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY . .

# Copy composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Create tmp and logs directories if they don't exist
RUN mkdir -p tmp logs

# Set permissions for tmp and logs
RUN chown -R www-data:www-data tmp logs

# Optional: Run post-deploy migrations if the script exists
RUN if [ -f bin/post-deploy.sh ]; then \
        chmod +x bin/post-deploy.sh && bin/post-deploy.sh; \
    else \
        echo "No post-deploy.sh found. Skipping migrations."; \
    fi

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
