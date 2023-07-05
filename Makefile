install:
	@make cp
	@make down
	@make build
	@make up
	@make composer-update
	@make data
	@make perm-storage

cp:
	cd application/ && rm .env -f && cp .env.example .env && cd ..
down:
	docker-compose down --remove-orphans
build:
	docker-compose build --no-cache --force-rm
up:
	docker-compose up -d
composer-update:
	docker exec dataseed-app bash -c 'composer update && php artisan key:generate && php artisan jwt:secret'
data:
	docker exec dataseed-app bash -c 'php artisan migrate && php artisan db:seed'
perm-storage:
	docker exec -t dataseed-app bash -c 'chown -R www-data:www-data /var/www/storage'	
in:
	docker exec -it dataseed-app bash
test:
	docker exec dataseed-app bash -c 'php artisan test'
stop:
	docker-compose stop
