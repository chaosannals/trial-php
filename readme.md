# [trial](https://github.com/chaosannals/trial-php)

## 镜像

```sh
docker build -t phpext .
```

## 容器

```sh
docker run -itd -p 19000:9000 -v /host/path:/phpext --name phpext-fpm phpext
```

## Nginx

```nginx
worker_processes 2;

events {
    worker_connections  1024;
}

http {
    include       mime.types;
    default_type  application/octet-stream;
    # sendfile        on;
    keepalive_timeout  65;

    server {
        listen         28886;
        server_name    _;
        root          /path/to/phpext/public; # 这里是 nginx 容器路径
        error_page     404 = @phpfcgi;

        location = /index.php {
            return 404;
        }

        location / {
            try_files $uri @phpfcgi;
        }

        location @phpfcgi {
            fastcgi_pass    127.0.0.1:19000;
            fastcgi_param   PATH_INFO $uri;
            fastcgi_param   SCRIPT_FILENAME   /phpext/public/index.php; # 这里是 php 容器内路径
            include         fastcgi_params;
        }
    }
}
```

## 编译

```sh
cd /phpext/phpext
phpize
./configure
make
make install
```

```ini
extension=phpext.so
```
