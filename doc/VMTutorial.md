## Virtual Machine Server

#### Virtual Machine Properties

IP: `137.44.11.211`
OS: `Ubuntu 18.04`

#### How to SSH into Virtual Machine

Install and setup Linux subsystem for Windows if you are developing on a windows machine.

Use the following commmand to ssh into the machine: `sudo ssh {USERNAME}@{IP}`.

#### Setting up the Server.

1. Install git with the following command: `sudo apt install git-all`.
2. From within the root of the home directory checkout the master of the repo: `git clone https://BradBitt@bitbucket.org/BradBitt/checkmate.git`.
3. CD into the repo just checked out and then cd into the `scripts/` folder.
4. Next to setup the server and install all its dependencies, make the setup shell script runnable with the following command: `chmod +x ./run-setup.sh`.
5. Run the setup script with the following command: `sudo ./run-setup.sh`.

The website run in the docker container can then be access by using the following URL in your browser: `http://137.44.11.211:8080/`.