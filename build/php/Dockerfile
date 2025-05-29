FROM php:8.3-fpm
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip zip curl pkg-config \
    libzip-dev libicu-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev default-libmysqlclient-dev libonig-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pdo_mysql mbstring xml intl opcache bcmath
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN pecl install redis && docker-php-ext-enable redis
RUN rm -rf /tmp/pear
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"