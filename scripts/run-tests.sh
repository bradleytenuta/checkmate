#!/bin/bash

# Builds the database and runs the tests.
cd ..
cd src

# Makes sure composer modules are up to date.
composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts

# Creates the '.env' file and generates a key.
cp .env.example .env
php artisan key:generate

# Creates the symbolic link.
php artisan storage:link

# Migrates and seeds the database.
php artisan migrate:fresh --seed

# Runs the tests.
vendor/bin/phpunit