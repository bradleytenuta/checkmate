#!/bin/bash

# Creates the '.env' file and generates a key.
cd ..
cd src
cp .env.example .env
php artisan key:generate