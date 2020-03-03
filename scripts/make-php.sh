#!/bin/bash

# Adds the repo that contains PHP 7.3 to apt.
# Installs any other requirements and then updates Apt.
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update

# Installs PHP 7.3
sudo apt-get install php7.3