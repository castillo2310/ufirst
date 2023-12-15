FROM php:8.2-fpm-alpine

WORKDIR "/backend"

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

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --optimize-autoloader