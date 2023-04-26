DOCKER_COMPOSE = docker compose
SYMFONY = $(DOCKER_COMPOSE) exec php bin/console
COMPOSER = $(DOCKER_COMPOSE) exec php composer

phpstan:
	$(DOCKER_COMPOSE) exec php vendor/bin/phpstan analyse -c phpstan.neon --memory-limit=1024M

assets-install:
	$(DOCKER_COMPOSE) -f docker-compose.yml -f docker-compose.override.yml run --rm node yarn install

assets-build:
	$(DOCKER_COMPOSE) -f docker-compose.yml -f docker-compose.override.yml run --rm node yarn dev

assets-watch:
	$(DOCKER_COMPOSE) -f docker-compose.yml -f docker-compose.override.yml run --rm node yarn watch

db:
	$(SYMFONY) doctrine:database:create

migration:
	$(SYMFONY) make:migration

migrate:
	$(SYMFONY) doctrine:migrations:migrate --no-interaction