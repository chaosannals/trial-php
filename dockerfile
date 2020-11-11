FROM phpswoole/swoole:4.5.7-php7.4

WORKDIR /app
VOLUME ["/app"]
EXPOSE 9051

COPY ./launch /
RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
    echo -e "\nswoole.use_shortname = 'Off'\n" >> /usr/local/etc/php/php.ini

ENTRYPOINT [ "bash", "/launch" ]
