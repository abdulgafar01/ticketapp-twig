# 1️⃣ Use the official PHP-Apache image
FROM php:8.2-apache

# 2️⃣ Install system dependencies
RUN apt-get update && apt-get install -y unzip git && rm -rf /var/lib/apt/lists/*

# 3️⃣ Enable Apache mod_rewrite
RUN a2enmod rewrite

# 4️⃣ Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5️⃣ Copy the entire app to Apache web directory
COPY . /var/www/html/

# 6️⃣ Set working directory to project root (not /public yet)
WORKDIR /var/www/html

# 7️⃣ Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader || true

# 8️⃣ Change Apache document root to /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# 9️⃣ Ensure Apache can serve index.php
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

# 🔟 Set file permissions
RUN chown -R www-data:www-data /var/www/html

# 1️⃣1️⃣ Expose port 80
EXPOSE 80

# 1️⃣2️⃣ Start Apache
CMD ["apache2-foreground"]
