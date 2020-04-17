# This docker container contains Alpine Linux instead of Ubunto.
FROM php:7.3-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

# Includes the PHP extension 'zip'.
RUN apk add --no-cache libzip-dev && docker-php-ext-configure zip --with-libzip=/usr/include && docker-php-ext-install zip

# Includes perl to be installed within the php container.
RUN apk add perl

# Adds docker-compose to the php container. This is so it can create maven containers and run them.
RUN apk add docker openrc
RUN apk update

# Builds all the docker containers that are used for testing.
RUN cd kits/java && docker build --tag kits-java:1.0 .