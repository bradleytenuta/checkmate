#!/bin/bash

#----------
# This file should only be run on Bitbucket Pipelines Cloud Server
#----------

# Builds the database and runs the tests.
cd ..
cd src

# Makes sure composer modules are up to date.
composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts

# Converts the mysql host to work on bitbucket
sed -i 's/DB_HOST=mysql/DB_HOST=127.0.0.1/g' .env.example

# Creates the '.env' file and generates a key.
cp .env.example .env
php artisan key:generate

# Creates the symbolic link.
php artisan storage:link

# Migrates and seeds the database.
php artisan migrate:fresh --seed

# Runs the tests.
vendor/bin/phpunit