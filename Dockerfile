FROM php:8.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Enable PHP extensions needed for cURL
RUN docker-php-ext-install curl

# Copy project files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html
