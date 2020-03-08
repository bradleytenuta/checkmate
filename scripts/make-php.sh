#!/bin/bash

# Adds the repo that contains PHP 7.3 to apt.
# Installs any other requirements and then updates Apt.
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update

# Installs PHP 7.3
sudo apt-get install php7.3 php7.3-mbstring php7.3-xmlrpc php7.3-soap php7.3-gd php7.3-xml php7.3-cli php7.3-zip