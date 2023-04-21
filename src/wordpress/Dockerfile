FROM wordpress:6.2.0-php8.2-fpm

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

COPY install-composer.sh composer.json ./

RUN sh install-composer.sh

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions \
  && install-php-extensions \
    pcntl \
    protobuf \
    opentelemetry-1.0.0beta4

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist

COPY . /opt/wordpress/

ENTRYPOINT [ "bash", "/opt/wordpress/start.sh", "php-fpm"]
