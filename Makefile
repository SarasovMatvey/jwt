init:
	docker-compose build && docker-compose up -d server php

run:
	docker-compose up --no-log-prefix client

cs:
	vendor/bin/php-cs-fixer fix app