#!/bin/bash

cd ..

# Updates compose, npm and refreshes the database.
sudo docker-compose run --rm composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts
sudo docker-compose run --rm npm install
sudo docker-compose run --rm npm run dev

cp ./src/.env.example ./src/.env

sudo docker-compose exec php php /var/www/html/artisan key:generate
sudo docker-compose exec php php /var/www/html/artisan storage:link
sudo docker-compose exec php php /var/www/html/artisan migrate:refresh --seed