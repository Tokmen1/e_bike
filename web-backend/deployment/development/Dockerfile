# FROM php:8.0-fpm
FROM php:8.0.5-fpm-alpine
WORKDIR /var/www

# RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev
RUN docker-php-ext-install pgsql pdo pdo_pgsql
# && docker-php-ext pdo_pgsql
# RUN apk add libpq-dev \
# && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
# && docker-php-ext-install pdo pdo_pgsql pgsql
# RUN docker-php-ext pdo_pgsql

COPY deployment/development/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY deployment/development/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY deployment/development/php.ini /usr/local/etc/php/php.ini

RUN apk add bash\ 
    && apk update

EXPOSE 9000

ENV COMPOSER_MEMORY_LIMIT=-1

ENTRYPOINT ["deployment/development/entrypoint.sh"]
