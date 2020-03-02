#!/bin/bash

## Sets up docker repository.
# Downloads dependenices.
sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common

# Adds Docker’s official GPG key:
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

# Verifies that we have installed docker with the key correctly.
sudo apt-key fingerprint 0EBFCD88

# Gets the stable version of the docker repo.
sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"

## Installs docker engine.
# Updates packages.
sudo apt-get update

# Installs the latest version of Docker Engine.
sudo apt-get install docker-ce docker-ce-cli containerd.io

# Verifies the installation.
sudo docker run hello-world