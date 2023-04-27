DOCKER_COMPOSE = docker compose
SYMFONY = $(DOCKER_COMPOSE) exec php bin/console
COMPOSER = $(DOCKER_COMPOSE) exec php composer

init:
	$(DOCKER_COMPOSE) up -d

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

phpcs:
	$(DOCKER_COMPOSE) exec php vendor/bin/phpcs --standard=phpcs.xml.dist --extensions=php --tab-width=4 -sp src

phpcs-fix:
	$(DOCKER_COMPOSE) exec -e PHP_CS_FIXER_IGNORE_ENV=1 php tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --allow-risky=yes
	$(DOCKER_COMPOSE) exec php vendor/bin/phpcbf --standard=phpcs.xml.dist --extensions=php --tab-width=4 -sp src

check:
	make phpcs
	make phpstan