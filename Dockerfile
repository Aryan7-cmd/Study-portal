FROM php:8.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Copy project files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html
