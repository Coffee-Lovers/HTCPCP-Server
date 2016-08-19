FROM coffeelovers/php:7.0-fpm

VOLUME /var/www/html
COPY . /var/www/html
WORKDIR /var/www/html
