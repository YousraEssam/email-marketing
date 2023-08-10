
## Email Marketing Tool

## Tools used
- **Laravel 10.1**
- **PHP 8.1**
- **PostgreSQL**
- **CkEditor 4**

## How to:
1- Clone github repository

2- Copy `.env.example` file to `.env`

3- Run `composer install`, then `php artisan key:generate`

4- Run `./vendor/bin/sail up` to setup docker environment along with server and database

Either using portainer to check you containers or through terminal,
you should find the following containers up, running and healthy

![img.png](public/images/img.png)

5- Go to `.env` file and edit: "DB_HOST = 172.29.0.2"

6- Run `sail artisan migrate:fresh` to migrate tables, then `sail artisan db:seed` to run seeds and get testing data

6- Go to `http://0.0.0.0:80` to access dashboard

## Notes:
1- To use "sail" instead of "./vendor/bin/sail", go to "~/.bashrc" file and add this:

`alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`

2- To install portainer, run the following commands:

`sudo docker volume create portainer_data`

then

`sudo docker run -d -p 9000:9000 -p 8000:8000 --name portainer --restart always -v /var/run/docker.sock:/var/run/docker.sock -v /srv/portainer:/data portainer/portainer-ce
the open the http://localhost:9000/ or if u changed the port put the new one and signup with email and a password`

then open `http://localhost:9000/`
