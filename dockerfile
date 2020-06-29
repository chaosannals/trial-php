FROM php:7.4-fpm

EXPOSE 9000
WORKDIR /phpext
VOLUME [ "/phpext" ]

RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

ENTRYPOINT [ "php-fpm" ]
