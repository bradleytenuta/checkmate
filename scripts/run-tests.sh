#!/bin/bash

# Sets up the server.
chmod +x ./make-env.sh
./make-env.sh

# Builds the database and runs the tests.
cd ..
cd src
php artisan migrate
vendor/bin/phpunit