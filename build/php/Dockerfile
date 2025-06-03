FROM php:8.3-fpm
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo pdo_mysql json openssl mbstring xml tokenizer ctype bcmath curl dom fileinfo pcre tokenizer xml filter opcache gd xdebug
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"