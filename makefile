uid=$(shell id -u)
gid=$(shell id -g)

.PHONY: test

composer-install:
	docker run --rm -u $(uid):$(gid) -v $(shell pwd):/app -w /app docker.io/composer:2.2.7 upgrade phpstan/phpstan

phpstan:
	docker run --rm -u $(uid):$(gid) -v $(shell pwd):/app -w /app docker.io/php:8.1.3-cli-alpine3.15 vendor/bin/phpstan analyse

phpunit:
	docker run --rm -u $(uid):$(gid) -v $(shell pwd):/app -w /app docker.io/php:8.1.3-cli-alpine3.15 vendor/bin/phpunit tests --configuration phpunit.xml