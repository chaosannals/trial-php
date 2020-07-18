

### 容器安装 Composer 库

```sh
docker run -it -v /host/app:/app -w /app --entrypoint composer --name phpci phpswoole/swoole:4.4.18-php7.4 install
```

### 部署镜像

```sh
docker build -t exert-think-swoole .
```

### 部署容器

```sh
docker run -d -v /host/app:/app -p 8000:80 --name exert-think-swoole exert-think-swoole
```