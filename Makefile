#! /bin/bash

DOCKERING_PHP = php-fpm
UID = $(shell id -u)
DOCKER_NETWORK = stackoverflow-network


##	create-network:			create the default network
create-network:
		docker network create ${DOCKER_NETWORK} | true


##	start:					get up environment (PHP + MYSQL + NGINEX)
start: create-network
		U_ID=${UID} docker-compose up -d


##	stop:					stop the containers
stop:
		U_ID=${UID}	docker-compose stop


## interactive:				runs php container with an interactive shell
interactive: create-network
		$(MAKE) start | true
		U_ID=${UID} docker exec -it --user ${UID} ${DOCKERING_PHP} bash


## run-test:				runs test
run-test:
		@U_ID=${UID} docker exec --user ${UID} -it ${DOCKERING_PHP} php bin/phpunit --testdox


## install:					install dependecies with compose
install:
		@U_ID=${UID} docker exec --user ${UID} -it ${DOCKERING_PHP} composer install --no-scripts --no-interaction --optimize-autoloader


## deploy:					deploy project
deploy:
	-@$(MAKE) start
	-@$(MAKE) install
	-@U_ID=${UID} docker exec --user ${UID} -it ${DOCKERING_PHP} php bin/console cache:clear -e prod;
	-@U_ID=${UID} docker exec --user ${UID} -it ${DOCKERING_PHP} php bin/console cache:warmup -e prod;
	-@$(MAKE) run-test