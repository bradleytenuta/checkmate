#!/bin/bash

# Updates installed packages.
sudo apt-get update
sudo dpkg --configure -a
sudo apt install curl
sudo apt install vim # For editing on the server.
sudo chmod +x ./run-docker-shutdown.sh # Prepares the shutdown shell script (which is never used).

# Installs Composer
chmod +x ./make-composer.sh
./make-composer.sh

# Prepares Laravel project
chmod +x ./run-laravel-setup.sh
./run-laravel-setup.sh

# Installs Docker
chmod +x ./make-docker.sh
./make-docker.sh

# Runs docker
chmod +x ./run-docker.sh
./run-docker.sh

# Installs and updates everything on the server.
chmod +x ./run-update.sh
./run-update.sh

# Creates and Runs the Linux Cron Job on the server.
chmod +x ./make-cron.sh
./make-cron.sh