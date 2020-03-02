#!/bin/bash

# Sets up the server.
./make-env.sh

# Builds the database and runs the tests.
cd ..
cd src
php artisan migrate
vendor/bin/phpunit