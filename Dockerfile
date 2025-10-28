# Use the official PHP-Apache image
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y unzip git && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy app source code to Apache web directory
COPY . /var/www/html/

# Change working directory to the public folder
WORKDIR /var/www/html/public

# Update Apache document root to /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Install PHP dependencies (Composer)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
