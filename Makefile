DOCKER_COMPOSE = docker compose
SYMFONY = $(DOCKER_COMPOSE) exec php bin/console
COMPOSER = $(DOCKER_COMPOSE) exec php composer

phpstan:
	$(DOCKER_COMPOSE) exec php vendor/bin/phpstan analyse -c phpstan.neon --memory-limit=1024M