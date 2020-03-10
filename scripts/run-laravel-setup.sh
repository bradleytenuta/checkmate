#!/bin/bash

# Goes into 'src' folder and performs initial laravel setup
cd ..
cd src

# Creates the .env file
cp .env.example .env

# Gives permissions to execute artisan file.
sudo chmod +x artisan

# Gives permission to everyone to use the storage folder. Only way to get around this.
sudo chmod -R a+rwx storage