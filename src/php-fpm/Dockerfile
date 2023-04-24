FROM composer:2 as builder

WORKDIR /var

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions \
  && install-php-extensions \
    pcntl \
    protobuf \
    opentelemetry-1.0.0beta3

COPY composer.json .
RUN composer install


FROM php:8.2-fpm as runtime

WORKDIR /var/www/html

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions \
  && install-php-extensions \
    pcntl \
    protobuf \
    opentelemetry-1.0.0beta3

COPY --from=builder /var/vendor ./vendor

COPY *.php .
