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

## Ports

Below are the used containers and their ports:

- nginx - `:8080`
- mysql - `:3306`
- php - `:9000`
- npm
- composer
- artisan