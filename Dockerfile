FROM php:8.1.10-fpm-alpine
COPY . /var/www/html/
# Install extension
RUN docker-php-ext-install pdo pdo_mysql
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
