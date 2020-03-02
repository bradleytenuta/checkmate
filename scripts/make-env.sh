#!/bin/bash

# Creates the '.env' file and generates a key.
echo $PWD
cd ..
cd src
echo $PWD
cp .env.example .env
php artisan key:generate