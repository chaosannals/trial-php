# ext demo

## 编译

### Windows

扩展 Windows 下必须和 php-src 源码一起编译，无法和 Linux 那样使用 phpize 单独编译。

[官方 Windows 开发扩展工具](https://github.com/php/php-sdk-binary-tools)
检出指定版本，该项目子模块版本是 php-sdk-2.2.0 ，执行 phpsdk-vs16-x64.bat 需要根据安装的 vs 安装 vc++ 桌面开发。

注意事向：
1. VS 默认的 VSINSTALLDIR 环境变量可能最后没有反斜杠，要补上，不然 phpsdk-vs16-x64.bat 路径拼接有问题。
2. 目前 php 只支持 vs2019 如果装了 vs2022 VSINSTALLDIR 会指向 vs2022 所以需要执行脚本前执行修改这个环境变量。
3. 编译完后通过 git clean 清理
4. 如果源码都拉好，也可以一步到位，例如 C:\php-sdk\phpsdk-vc15-x64.bat -cur_console:d:C:\php-sdk\php72\vc15\x64\php-src 把路径指定好。（未试）
5. 有时候编译报错，可能编译工具和源码版本的问题，切换几个试试。

```powershell
git checkout -b v2.2.0 php-sdk-2.2.0

$env:VSINSTALLDIR="C:\Program Files (x86)\Microsoft Visual Studio\2019\Community\"

git clean -xfd
```

执行完 phpsdk-vs16-x64.bat 正常后编译环境就被配置好了，进入可以编译的命令状态。

执行 phpsdk_buildtree phpmaster 选定构建
转到 php-src（需要拉去 php 源码） 目录
下载依赖 phpsdk_deps --update --branch master 或者 phpsdk_deps --update --branch X.Y
执行编译 buildconf && configure --enable-cli && nmake


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