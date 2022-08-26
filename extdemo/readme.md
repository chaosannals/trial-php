# ext demo

## 编译

### Linux

```sh
cd /phpext/phpext
phpize
./configure
make
make install
```

```sh
cat /usr/local/etc/php/php.ini-development > /usr/local/etc/php/php.ini
echo "\nextension=phpext.so" >> /usr/local/etc/php/php.ini
```

```ini
extension=phpext.so
```

## Docker

### 镜像

```sh
docker build -t phpext .
```

### 容器

```sh
docker run -itd -p 19000:9000 -v /host/path:/phpext --name phpext-fpm phpext
```