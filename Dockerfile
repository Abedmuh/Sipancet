# Use the official PHP 8 image
FROM php:8.0-fpm

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Download Composer installer script
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php

# Verify the installer SHA-384 (replace with latest hash from https://getcomposer.org/download/)
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); } echo PHP_EOL;"

# Install Composer
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Clean up
RUN php -r "unlink('composer-setup.php');"

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the PHP project files to the container
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 9000 for PHP-FPM
EXPOSE 9000
