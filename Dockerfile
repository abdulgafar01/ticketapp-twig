# 1️⃣ Use an official lightweight PHP image
FROM php:8.2-apache

# 2️⃣ Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# 3️⃣ Enable Apache mod_rewrite (useful if you have clean URLs later)
RUN a2enmod rewrite

# 4️⃣ Copy your project into the Apache web directory
COPY . /var/www/html/

# 5️⃣ Set working directory
WORKDIR /var/www/html/public

# 6️⃣ Expose port 80
EXPOSE 80

# 7️⃣ Start Apache
CMD ["apache2-foreground"]
