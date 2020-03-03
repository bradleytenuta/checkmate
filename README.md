## Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-windows/).

Make sure you have windows 10 Education or Windows 10 Pro. Mac and Linux will also be fine.

Make sure that the symbolic link between the `public/storage` and `storage/app` are created. Use this command `php artisan storage:link` from within `/src`.

#### Commands

- `docker-compose up -d --build` - This will run the docker container. You can view the website at `http://localhost:8080`. The `d` command insures that the containers will keep running untill told otherwise.

Below you can run commands for composer, nom or artisan. Just add your desired command to the end.

- `docker-compose run --rm composer <COMMAND>`
- `docker-compose run --rm npm <COMMAND>`
- `docker-compose run --rm artisan <COMMAND>`

In order to turn off the docker containers, run the command `docker-compose down`.

#### How to use Docker Compose

Docker compose is a tool for defining and running multi container docker applications. The full documentation can be found [here](https://docs.docker.com/compose/). 

Docker compose can preserve data by looking for volumes when the docker is created. If docker finds these volumes then it copies its contents from the volume to the docker application volume. We use volumes for mysql so the data created in the database can be preserved if the docker were to shut down or be destroyed.

###### Useful Commands

- `docker-compose up` - Create and start containers
- `docker-compose start` - Start services
- `docker-compose stop` - Stop services
- `docker-compose down` - Stop and remove containers, networks, images, and volumes.

## Ports

Below are the used containers and their ports:

- nginx - `:8080`
- mysql - `:3306`
- php - `:9000`
- npm
- composer
- artisan

## Third Party Tools

#### MySQL Workbench

You can download MySQL Workbench from [here](https://www.mysql.com/products/workbench/). In order to connect to the database from within docker, you just need to provide the standard IP of `127.0.0.1` with the port provided from the ports section. The username and password of the databse can also be found within the `docker-compose.yml` file. 

**NOTE** MySql Workbench has only been tried and tested in development mode, not in production on a seperate VM.