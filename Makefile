#include laravel-app/.env.example

install:
	@make cp
	@make down
	@make build
	@make up
	@make composer-update
	@make perm-storage

cp:
	cd application/ && rm .env -f && cp .env.example .env && cd ..
composer-update:
	docker exec dataseed-app bash -c 'composer update && php artisan key:generate'	
perm-storage:
	docker exec -t dataseed-app bash -c 'chown -R www-data:www-data /var/www/storage'	
data:
	docker exec dataseed-app bash -c 'php artisan migrate'
	docker exec dataseed-app bash -c 'php artisan db:seed'
build:
	docker-compose build --no-cache --force-rm
down:
	docker-compose down --remove-orphans
in:
	docker exec -it dataseed-app bash
up:
	docker-compose up -d