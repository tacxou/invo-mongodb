FROM toroia/phalcon-fpm

ENV PHP_DISPLAY_ERRORS=On \
    PHP_DISPLAY_STARTUP_ERRORS=On

RUN apk update \
  && apk add --no-cache \
  -X http://dl-cdn.alpinelinux.org/alpine/edge/testing \
  php7-pecl-mongodb \
  && apk add --no-cache \
  php7-xdebug git \
  && echo -e "zend_extension=xdebug.so\nxdebug.remote_enable=On\nxdebug.remote_autostart=On\nxdebug.remote_idekey=PHPSTORM\nxdebug.remote_connect_back=On\nxdebug.remote_mode=req\nxdebug.remote_handler=dbgp" > /etc/php7/conf.d/xdebug.ini
