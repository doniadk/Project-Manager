FROM php:8.2-apache

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

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Create tmp and logs directories and set permissions
RUN mkdir -p /var/www/html/tmp /var/www/html/logs \
    && chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Optional: run migrations if bin/post-deploy.sh exists
RUN if [ -f bin/post-deploy.sh ]; then \
        chmod +x bin/post-deploy.sh && bin/post-deploy.sh; \
    else \
        echo "No post-deploy.sh found. Skipping migrations."; \
    fi

EXPOSE 80
CMD ["apache2-foreground"]
