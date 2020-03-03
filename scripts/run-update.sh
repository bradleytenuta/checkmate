#!/bin/bash

cd ..

# Updates compose, npm and refreshes the database.
docker-compose run --rm composer update
docker-compose run --rm npm install
docker-compose run --rm npm run dev
docker-compose run --rm artisan migrate:fresh --seed