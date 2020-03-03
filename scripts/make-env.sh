#!/bin/bash

cd ..
cd src

# Makes sure composer modules are up to date.
composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts

# Creates the '.env' file and generates a key.
cp .env.example .env
php artisan key:generate