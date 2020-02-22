# php 与 json 加载性能

实验上看，加载速度 json 快过 php。
json 是纯数据所以解释器比 php 解释器简单，加载速度更快。
json 用 file_get_contents 加载文件时，两者的差距并不是很大。
json 用 fopen fread 加载时，速度有轻微优势。

以下为（php 7.4.1 带 xdebug）执行结果：
> include php :                 1.1801278591156s
> file_get_contents json:       1.1673059463501s
> fread json:                   0.94873714447021s
