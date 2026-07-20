FROM php:8.3-apache

WORKDIR /var/www/html

RUN docker-php-ext-install pdo_mysql \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

COPY docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini