# Using official PHP runtime as parent
FROM php:8.2-apache

#install depencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

#set working dir in container
WORKDIR /var/www/html

COPY ./var/www/html

# Adding Postgres support:
RUN docker-php-ext-install pdo_pgsql

# Copy custom Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite

# Set Apache to bind to IP address 0.0.0.0
# RUN echo "Listen 0.0.0.0:80" >> /etc/apache2/apache2.conf

# Expose port 80 to allow incoming connections to the container
EXPOSE 80