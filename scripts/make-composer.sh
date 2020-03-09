#!/bin/bash

# Installs dependencies. Including PHP.
sudo apt update
sudo apt install libapache2-mod-php7.3 php7.3-mbstring php7.3-xmlrpc php7.3-soap php7.3-gd php7.3-xml php7.3-cli php7.3-zip

# Installs Composer
sudo curl -sS https://getcomposer.org/installer

# Adds composer to env var
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
source ~/.bashrc

# Checks Composer is installed correctly.
composer -v