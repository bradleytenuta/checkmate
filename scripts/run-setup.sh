#!/bin/bash

# Updates installed packages.
sudo apt-get update
sudo dpkg --configure -a

# Installs PHP
chmod +x ./make-php.sh
./make-php.sh

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