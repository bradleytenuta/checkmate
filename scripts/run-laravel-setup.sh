#!/bin/bash

# Goes into 'src' folder and performs initial laravel setup
cd ..
cd src

# Creates the .env file
cp .env.example .env

# Gives permissions to execute artisan file.
chmod +x artisan