#!/bin/bash

# Updates installed packages.
sudo apt-get update
sudo dpkg --configure -a

# Installs PHP
./make-php.sh

# Installs Docker
./make-docker.sh

# Prepares the server.
./make-env.sh

# Runs docker
./run.sh

# Installs and updates everything on the server.
./run-update.sh