FROM php:8.2-fpm-alpine

WORKDIR "/app"

RUN apk add --no-cache \
      acl \
      file \
      gettext \
      git \
;

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && apk add --update linux-headers \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

COPY ./docker/app.dev.ini $PHP_INI_DIR/conf.d/

COPY --from=composer/composer:2-bin /composer /usr/bin/composer