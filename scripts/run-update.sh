#!/bin/bash

cd ..

# Updates compose, npm and refreshes the database.
sudo docker-compose run --rm composer install
sudo docker-compose run --rm npm install
sudo docker-compose run --rm npm run dev
sudo docker-compose exec php php /var/www/html/artisan migrate:fresh --seed
# Below is not working, problem with docker accessing artisan.
#sudo docker-compose run --rm artisan migrate:fresh --seed