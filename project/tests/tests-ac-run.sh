#!/bin/bash

docker exec backend "/var/www/bin/phpunit"
docker run --net=host -v $PWD/acceptance/:/tests codeceptjs/codeceptjs codeceptjs run