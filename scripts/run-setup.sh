#!/bin/bash

# Updates installed packages.
sudo apt-get update
sudo dpkg --configure -a
sudo apt install curl

# Installs PHP
chmod +x ./make-php.sh
./make-php.sh

# Installs Composer
chmod +x ./make-composer.sh
./make-composer.sh

# Installs Docker
chmod +x ./make-docker.sh
./make-docker.sh

# Prepares the server.
chmod +x ./make-env.sh
./make-env.sh

# Runs docker
chmod +x ./run-docker.sh
./run-docker.sh

# Installs and updates everything on the server.
chmod +x ./run-update.sh
./run-update.sh

# Prepares the shutdown shell script.
chmod +x ./run-docker-shutdown.sh