# ext demo

## 编译

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
