FROM php:8.0.8-fpm-alpine

RUN apk add --no-cache --update \
  bzip2-dev \
  enchant2-dev \
  libpng-dev \
  gmp-dev \
  imap-dev \
  icu-dev \
  openldap-dev \
  freetds-dev \
  postgresql-dev \
  aspell-dev \
  net-snmp-dev \
  libxml2-dev \
  tidyhtml-dev  \
  libxslt-dev \
  libzip-dev
  
RUN docker-php-ext-install \
  bcmath \
  bz2 \
  calendar \
  dba \
  enchant \
  exif \
  ffi \
  gd \
  gettext \
  gmp \
  imap \
  intl \
  ldap \
  mysqli \
  opcache \
  pcntl \
  pdo_dblib \
  pdo_mysql \
  pdo_pgsql \
  pgsql \
  pspell \
  shmop \
  snmp \
  soap \
  sockets \
  sysvmsg \
  sysvsem \
  sysvshm \
  tidy \
  xsl \
  zend_test \
  zip
	
RUN curl -s https://getcomposer.org/installer | php \
  # move composer into a bin directory you control:
  && mv composer.phar /usr/local/bin/composer \
  # double check composer works
  && composer about

RUN php -m && echo "============================================="

WORKDIR /var/www

RUN apk add bash

RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN php -m && echo "============================================="

CMD symfony server:ca:install

CMD symfony server:start
