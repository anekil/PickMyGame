#!/usr/bin/env bash

composer install -n
symfony console make:migration
symfony console doctrine:migrations:migrate

exec "$@"