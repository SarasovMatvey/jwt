init:
	docker-compose build && docker-compose up -d server php

run:
	docker-compose up --no-log-prefix client

cs:
	vendor/bin/php-cs-fixer fix app

speed-tests:
	docker-compose up --build speed-tests

functional-tests:
	docker-compose up --build functional-tests

unit-tests:
	vendor/bin/phpunit tests/Unit