FROM php:8.2-fpm-alpine

WORKDIR "/backend"

RUN apk add --no-cache \
      acl \
      file \
      gettext \
      git \
      nginx \
      supervisor \
;

COPY docker/prod/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/prod/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/prod/app.prod.ini /usr/local/etc/php/conf.d/99-overrides.ini

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader
RUN composer dump-autoload --no-dev --classmap-authoritative

EXPOSE 80

RUN chmod +x docker/prod/entrypoint.sh

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]