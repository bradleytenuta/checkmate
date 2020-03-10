## Table Of Contents

Below is a list of internal links to the different sections of the document.

1. <a href="#setup">Set-up</a>
1. <a href="#docker">Docker</a>
1. <a href="#laravel">Laravel</a>
1. <a href="#database">Database</a>
1. <a href="#moss">Moss</a>
1. <a href="#tpt">Third Party Tools - Development</a>
1. <a href="#mvp">Minimal Viable Product</a>

<br>
<br>
<br>
<br>

## [Set-up](#setup)

### Development

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-windows/).

Make sure you have windows 10 Education or Windows 10 Pro. Mac and Linux will also be fine.

Make sure that the symbolic link between the `public/storage` and `storage/app` are created. Use this command `php artisan storage:link` from within `/src`.

##### Commands

- `docker-compose up -d --build` - This will run the docker container. You can view the website at `http://localhost:8080`. The `d` command insures that the containers will keep running until told otherwise.

Below you can run commands for composer, npm or artisan. Just add your desired command to the end.

- `docker-compose run --rm composer <COMMAND>`
- `docker-compose run --rm npm <COMMAND>`
- `docker-compose run --rm artisan <COMMAND>`

In order to turn off the docker containers, run the command `docker-compose down`.

##### How to use Docker Compose

Docker compose is a tool for defining and running multi container docker applications. The full documentation can be found [here](https://docs.docker.com/compose/). 

Docker compose can preserve data by looking for volumes when the docker is created. If docker finds these volumes then it copies its contents from the volume to the docker application volume. We use volumes for mysql so the data created in the database can be preserved if the docker were to shut down or be destroyed.

##### Useful Commands

- `docker-compose up` - Create and start containers
    - `up d` - `d` is a subcommand for `up` that runs the containers in detached mode and runs containers in the background.
- `docker-compose start` - Start services
- `docker-compose stop` - Stop services
- `docker-compose down` - Stop and remove containers, networks, images, and volumes.

##### Ports

Below are the used containers and their ports:

- nginx - `:8080`
- mysql - `:3306`
- php - `:9000`
- npm
- composer
- artisan

### Production (Virtual Machine)

##### Virtual Machine Properties

IP: `137.44.11.211`
OS: `Ubuntu 18.04`

##### How to SSH into Virtual Machine

Install and set-up Linux subsystem for Windows if you are developing on a windows machine.

Use the following command to ssh into the machine: `sudo ssh {USERNAME}@{IP}`.

##### Setting up the Server.

1. Install git with the following command: `sudo apt install git-all`.
2. From within the root of the home directory checkout the master of the repo: `git clone https://BradBitt@bitbucket.org/BradBitt/checkmate.git`.
3. CD into the repo just checked out and then `cd` into the `scripts/` folder.
4. Next to set-up the server and install all its dependencies, make the set-up shell script runnable with the following command: `chmod +x ./run-setup.sh`.
5. Run the set-up script with the following command: `./run-setup.sh`.

**NOTE** Don't run this command with `sudo`, we don't want the files it creates to belong to the root user.

**NOTE** Nginx uses port `8080` on the development machine and port `80` in production.

The website run in the docker container can then be access by using the following URL in your browser: `http://137.44.11.211:80/` or `ma-902559.swansea.ac.uk`.

Below are some additional commands that should also be run. This will help protect the computer by turning on the firewall and allowing ssh (but limited). They should be run in the order provided below and only run the second command if the first command does not return any errors:

- `sudo ufw allow OpenSSH`
- `sudo ufw enable`

##### Ports

Below are the used containers and their ports:

- nginx - `:80`
- mysql - `:3306`
- php - `:9000`
- npm
- composer
- artisan

<br>
<br>
<br>
<br>

## [Docker](#docker)

Docker is a platform for developers and sysadmins to build, run, and share applications with containers. The use of containers to deploy applications is called containerization. Containers are not new, but their use for easily deploying applications is.

Fundamentally, a container is nothing but a running process, with some added encapsulation features applied to it in order to keep it isolated from the host and from other containers. One of the most important aspects of container isolation is that each container interacts with its own private filesystem; this filesystem is provided by a Docker image. An image includes everything needed to run an application - the code or binary, runtimes, dependencies, and any other filesystem objects required.

##### Docker-compose

The Docker container I created was cloned from the following repository: [aschmelyun](https://github.com/aschmelyun/docker-compose-laravel).

Compose is a tool for defining and running multi-container Docker applications. With Compose, you use a YAML file to configure your application’s services. Then, with a single command, you create and start all the services from your configuration.

Using Compose is basically a three-step process:

1. Define your app’s environment with a Dockerfile so it can be reproduced anywhere.
1. Define the services that make up your app in docker-compose.yml so they can be run together in an isolated environment.
1. Run docker-compose up and Compose starts and runs your entire app.

Compose preserves all volumes used by your services. When docker-compose up runs, if it finds any containers from previous runs, it copies the volumes from the old container to the new container. This process ensures that any data you’ve created in volumes isn’t lost.

##### Tests

All tests run on bitbucket are run within a docker container.

##### Testing Submissions

Docker is used to run the provided coursework unit tests on the user submissions. This is done by using a Maven image docker container. Then the unit tests and submission code are added to the container and then Maven is used to run the tests. A report is produced which is then returned to the main docker container which contains the website.

<br>
<br>
<br>
<br>

## [Laravel](#laravel)

##### Other Notes

- `composer dump-autoload` can be used to refresh your seeder files. If when seeding or migrating, php can't find your classes, then run the command and try again.
- Migration files that only have a single primary key that is an incrementing integer will get automatically claimed as a PK when migrating, this means you do not have to specify it in the migration file, if you do, it will break it.
- `$table->unique('[val]')` is used when you want to specify something as unique but not used as a primary key, just like an email.
- Don't need to include the id in the factory as it is incremented automatically when that model object is created.
- `Timestamps` in migration files creates two columns, one for the date of creation and one for the date of last updated.
- use `php artisan migrate:fresh` instead of `php artisan migrate:reset` also can combine it with seeding to speed things up: `php artisan migrate:fresh --seed`. This also stops problems with removing data occurring which is helpful.
- use `Schema::dropAllTables();` within tinker to drop all tables, instead of dropping them one by one.

<br>
<br>
<br>
<br>

## [Database](#database)

##### Users

Everyone who has an account is a user. The back-end will automatically check for an uploaded icon, if one can't be found then the default is used. Student and staff is only used to help filter out the users when assigning coursework. A student can still be a marker or an admin. A member of staff can be an admin, a student on a module or a marker.

##### Modules

A module contains one or multiple courseworks. Roles are given when the module is created. Students are added when the module is created.

##### Courseworks

Each module has a number of courseworks.

##### Submissions

The UserId is the user that submitted the coursework. Coursework items only take in zip files. They are stored in the coursework storage location. The JSON column is simply taking a json file and turning it into a string and placing it into the database. Then when you want to read it, take it out and convert it to json again, Laravel has this support already.

##### Permissions

A permission is an action a user can perform.

##### Roles

Roles provide a certain number of permissions.

##### Tests

This table includes each test that an assessor or professor uploads within a coursework. All the tests are collected and used to test a given submission.

##### Roles_Permissions - pivot

This table contains all the permissions that each role gets.

##### Users\_Roles_Modules - pivot

This table contains a list of all roles a user has for a specific module.
Module can only be null for admin role.

##### Users_Modules - pivot

This table contains a list of all the users and the modules they are signed up to. This includes users with different types of permissions.

##### Users_Roles - pivot

Global permissions for users.

<br>
<br>
<br>
<br>

## [Moss](#moss)

##### Instructions

When you compare two or more files, the results are uploaded to the moss server. The results can be web scrapped from there. Here is a link to where the results will be [stored](http://moss.stanford.edu/results/). The exact URL will be printed out at the end of the command.

Here is an example of the one I used to compare two Java files:

`perl moss.pl -l java C:\Users\bradl\Desktop\test\test1.java C:\Users\bradl\Desktop\test\test2.java`

More instructions can be found within the `moss.pl` file you copied over.

##### Installing Moss

1. In order to install moss you will need `cygwin` installed. Link to download can be found [here](https://www.cygwin.com/). Make sure to also install the whole perl package when you install `cygwin`.
1. Add `cygwin` folder and its `bin` folder to your environment variables.
1. Create a folder called 'moss'. 
1. Copy the below perl file called `moss.pl`, into the 'moss' directory.
1. Then from the directory above run this command: `chmod ug+x moss`.

<br>
<br>
<br>
<br>

## [Third Party Tools - Development](#tptd)

##### MySQL Workbench

You can download MySQL Workbench from [here](https://www.mysql.com/products/workbench/). In order to connect to the database from within docker, you just need to provide the standard IP of `127.0.0.1` with the port provided from the ports section. The username and password of the databse can also be found within the `docker-compose.yml` file. 

**NOTE** MySql Workbench has only been tried and tested in development mode, not in production on a seperate VM.

<br>
<br>
<br>
<br>

## [Minimal Viable Product](#mvp)

The contents of the minimal viable product for the 'checkmate' web application. The requirements below should be completed first before attempting any additional requirements.

###### User Requirements

- The user shall be able to change their password.
- The user shall be able to change their image.

###### Coursework Requirements

- Coursework shall have a name.
- Coursework shall have a deadline.
- Coursework shall have a total mark (int).
- Coursework shall have an owner.
- Coursework shall have a list of users with professor permissions.
- Coursework shall have a list of assignees (People who do the coursework).
- The owner of the coursework (The user that creates the coursework) can assign users as professors for that coursework.
- The user shall be able to mark coursework items that have been submitted after the deadline of the coursework, if they have professor permission on that coursework. This means submitting a result.
- A user that has professor permissions for a coursework cannot be assigned to that coursework.
- A user that has professor permissions for a coursework can create overall comments
- A user that has professor permissions for a coursework can create line specific comments.
- A user with professor permissions shall be able to overwrite a result of a coursework that has been completed and submitting with a result.
- A coursework owner shall be able to choose between a manual review or an automatic review (by unit tests, will be implemented as an additional).
- A coursework shall have a location on disk where all coursework item zips are uploaded to.

###### Home Page Requirements

- The user shall be able to view a list of all the coursework's they are assigned to.
- The user shall be able to view a list of courseworks's they have professor permission in.

###### Login Page Requirements

- The user shall be able to log into their account
- The user shall be able to change their password.
- The user shall be able to create an account.
- The user can view information about the web application: what it is, what it does, who it is for, who created it.

###### Create Account Page

- The user shall enter their first name.
- The user shall enter their second name.
- The user shall enter their email address.
- The user shall enter their password for the account.
- The user shall have the option to upload an image of themselves. If not then a default one will be used.
- The user shall be able to select if they are an admin. This gives the user permissions to create coursework and modules.
- The user shall be able to select the year they are in, if they select themselves as students and not as admin.

###### Create Module Page

- The user shall be able to enter a module name.
- The user shall be able to upload an icon for the module.

###### Create Coursework Page

- The user shall be able to enter a coursework name.
- The user shall be able to enter a deadline with a calendar.
- The user shall be able to enter a maximum score.
- The user shall be able to upload an icon.
- The user shall be able to add a description.

###### Navbar

- The navbar shall allow the user to log out.
- The navbar will only be displayed when a user is logged in.
- The navbar will provide a link to a page where the user can edit their account.
- The navbar shall allow the user to navigate back to the home page.
- The navbar shall provide an extra menu item to those with admin rights. This extra menu item shall allow the user to:
	- create coursework.
	- create modules.

#### Additional Requirements - Function Requirements

These shall only be completed once all the minimal requirements have been completed

- An admin user can upgrade another user who is not admin, to admin.
- A coursework owner shall be able to create Java unit tests and use these to automatically mark coursework.
- A coursework shall have the ability to hid or show unit tests so users can view some of the unit tests that the coursework will be marked with.

<br>
<br>
<br>
<br>
