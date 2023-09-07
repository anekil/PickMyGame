#!/usr/bin/env bash

rm migrations/*
composer install -n
symfony console make:migration
symfony console doctrine:migrations:migrate
symfony console app:fetch-data

exec "$@"