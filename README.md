# Fork from https://github.com/thayronarrais/docker-laravel-postgres-nginx

# Pre-requisites
* Docker running on the host machine.
* Docker compose running on the host machine.

Kroki do odpalenia serwisu : 

- `git clone https://github.com/maqmaqmaq/docker-laravel-postgres-nginx directory`
- cd into directory
- `docker-compose up -d`
- `docker exec -it app-php-fpm bash`
- `cp .env.example .env`
- `composer install`
- `php artisan migrate`

go to:

- http://localhost/api/save_courses -> zapis danych
- http://localhost/api/courses -> listowanie danych
- http://localhost/api/courses/EUR/mid -> listowanie danych dla danej waluty

Testy: 

`docker exec -it app-php-fpm php artisan test`

# Images
+ redis:alpine
+ postgres:12.1-alpine
+ nginx:alpine
+ php73-fpm:latest
