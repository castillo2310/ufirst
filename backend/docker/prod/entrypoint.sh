#!/bin/sh

/backend/bin/console cache:warmup --env=prod

php-fpm --nodaemonize
