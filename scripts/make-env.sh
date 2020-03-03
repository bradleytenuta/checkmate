#!/bin/bash

# Creates the '.env' file and generates a key.
cd ..
cd src
cp .env.example .env
php -v
php artisan key:generate