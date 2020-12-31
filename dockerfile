FROM phpswoole/swoole:4.5.10-php7.4

WORKDIR /app
VOLUME ["/app"]
EXPOSE 9051

RUN cp /usr/share/zoneinfo/PRC /etc/localtime && \
    composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
    echo -e "\nswoole.use_shortname = 'Off'\n" >> /usr/local/etc/php/php.ini && \
    sed -i 's/^\s*;\?\s*date\.timezone.*/date.timezone=PRC/g' /usr/local/etc/php/php.ini && \
    docker-php-ext-install pdo_mysql && \
    curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/5.3.2.tar.gz && \
    tar xfz /tmp/redis.tar.gz && \
    rm -r /tmp/redis.tar.gz && \
    mkdir -p /usr/src/php/ext && \
    mv phpredis-5.3.2 /usr/src/php/ext/redis && \
    docker-php-ext-install redis 

ENTRYPOINT [ "bash", "launch" ]
