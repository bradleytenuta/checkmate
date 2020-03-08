#!/bin/bash

# Installs dependencies.
sudo apt update
sudo apt install libapache2-mod-php

# Installs Composer
curl -sS https://getcomposer.org/installer | php

# Adds composer to env var
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
source ~/.bashrc

# Checks Composer is installed correctly.
composer -v