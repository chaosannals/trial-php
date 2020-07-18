FROM phpswoole/swoole:4.4.18-php7.4

WORKDIR /app
VOLUME ["/app"]
EXPOSE 80

ENTRYPOINT [ "php", "think",  "swoole"]
