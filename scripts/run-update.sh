#!/bin/bash

cd ..

# Updates compose, npm and refreshes the database.
sudo docker-compose run --rm composer install
sudo docker-compose run --rm npm install
sudo docker-compose run --rm npm run dev

# The 'refresh' function should be used instead of 'fresh' as it
# deletes coursework files through the 'down' function during roll back.
sudo docker-compose exec php php /var/www/html/artisan migrate:refresh --seed

# Below is not working, problem with docker accessing artisan.
#sudo docker-compose run --rm artisan migrate:refresh --seed