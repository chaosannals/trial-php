# exert hyperf

## 开发容器

```bash
# 使用官方的镜像创建开发容器
docker run --name hyperf -v /path/to/this/hyperf-server:/app -p 9501:9501 -p 9503:9503 -itd --privileged -u root --entrypoint /bin/sh  hyperf/hyperf:8.1-alpine-v3.18-swoole
```