#!/bin/bash

# Installs dependencies. Including PHP.
sudo apt update
sudo apt install php7.3 php7.3-mbstring php7.3-xmlrpc php7.3-soap php7.3-gd php7.3-xml php7.3-cli php7.3-zip

# Installs Composer
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Removes the Composer install file, as it's no longer needed.
sudo rm composer-setup.php