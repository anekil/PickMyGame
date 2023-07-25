#!/usr/bin/env bash

composer install -n
symfony console make:migration
# bin/console doc:fix:load --no-interaction

exec "$@"