FROM php:7.4-fpm

# create a user php connected to the default user
RUN groupadd --gid 1000 php \
  && useradd --uid 1000 --gid php --shell /bin/bash --create-home php

RUN apt-get update && \
    apt-get install -y \
     wget \
     git \
     libzip-dev \
     libicu-dev \
     ffmpeg

RUN docker-php-ext-install \
  pdo_mysql \
  intl \
  zip \
  opcache



# Install xdebug
RUN pecl install xdebug-2.9.3 \
    && docker-php-ext-enable xdebug
#install symfony gloablly
RUN wget https://get.symfony.com/cli/installer -O - | bash \
 && mv /root/.symfony/bin/symfony /usr/local/bin/symfony
#install composer
COPY composer.phar   /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

COPY xdebug.ini   /usr/local/etc/php/conf.d/30-xdebug.ini
COPY docker.ini   /usr/local/etc/php/conf.d/30-docker.ini

# login default with user php
USER php

# execute commands default in the following directory
WORKDIR /var/www/html
