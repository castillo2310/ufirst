FROM php:8.2-fpm-alpine

WORKDIR "/app"

RUN apk add --no-cache \
      acl \
      file \
      gettext \
      git \
   ;

COPY --from=composer/composer:2-bin /composer /usr/bin/composer