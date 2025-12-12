#!/bin/bash

./vendor/bin/php-cs-fixer fix src/
./vendor/bin/php-cs-fixer fix tests/
./vendor/bin/phpstan analyze src/
XDEBUG_MODE=coverage ./bin/phpunit tests/ --coverage-html=tests/coverage

#XDEBUG_MODE=coverage ./vendor/bin/paratest tests/ --coverage-html=tests/coverage
