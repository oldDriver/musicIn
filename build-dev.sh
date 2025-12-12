#!/bin/bash

echo "Copy environment"
cp project/.env.dist project/.env

echo "Clear cache folders"
rm -rf project/var/log
rm -rf project/var/cache

echo "Kill docker containers"
docker container kill $(docker ps -q)
docker system prune -f
docker-compose up -d --build

echo "Composer install"
docker exec backend rm -rf vendor
docker exec backend /usr/local/bin/composer install

echo "Drop/create database"
docker exec backend /var/www/bin/console doctrine:database:drop --force
docker exec backend /var/www/bin/console doctrine:database:create

echo "Run migrations"
docker exec backend /var/www/bin/console doctrine:migrations:migrate -n

echo "Load fixtures"
docker exec backend /var/www/bin/console doctrine:fixtures:load -n
