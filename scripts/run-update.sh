#!/bin/bash

cd ..

# Updates compose, npm and refreshes the database.
sudo docker-compose run --rm composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts
sudo docker-compose run --rm npm install
sudo docker-compose run --rm npm run dev

# Finishes setup of laravel project and migrates database.
sudo docker-compose run --rm artisan key:generate
sudo docker-compose run --rm artisan storage:link
sudo docker-compose run --rm artisan migrate:refresh --seed