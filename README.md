## Docker com PHP, NGINX e SUPERVISOR

```bash
#include laravel-app/.env.example

install:
	@make down
	@make build
	@make up

perm-storage:
	docker exec -t dataseed-app bash -c 'chown -R www-data:www-data /var/www/storage'	
build:
	docker-compose build --no-cache --force-rm
down:
	docker-compose down --remove-orphans
in:
	docker exec -it dataseed-app bash
up:
	docker-compose up -d
```