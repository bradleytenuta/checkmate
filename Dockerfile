FROM php:7.3-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

# Includes the PHP extension 'zip'.
RUN apk add --no-cache libzip-dev && docker-php-ext-configure zip --with-libzip=/usr/include && docker-php-ext-install zip

# Includes perl to be installed within the php container.
RUN apk add perl