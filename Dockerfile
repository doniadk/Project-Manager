# Use the official PHP image with Apache
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring

# Enable Apache mod_rewrite (needed for CakePHP routing)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set file permissions (adjust as needed)
RUN chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
