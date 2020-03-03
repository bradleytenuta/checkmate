#!/bin/bash

# Installs dependencies.
sudo apt update
sudo apt install php libapache2-mod-php php-mbstring php-xmlrpc php-soap php-gd php-xml php-cli php-zip

# Installs Composer
curl -sS https://getcomposer.org/installer | php

# Adds composer to env var
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
source ~/.bashrc

# Checks Composer is installed correctly.
composer -v

# Makes sure composer modules are up to date.
composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts