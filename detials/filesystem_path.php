<?php

// linux
$p1 = '/path/to/files/3/2/1.txt';
echo dirname($p1).PHP_EOL;
echo dirname($p1, 1).PHP_EOL; // 参数 1 默认值
echo dirname($p1, 3).PHP_EOL; // 向上 3 级目录

// windows
$p2 = 'C:\path\to\files\3\2\1.txt';
echo dirname($p2).PHP_EOL;
echo dirname($p2, 1).PHP_EOL; // 参数 1 默认值
echo dirname($p2, 3).PHP_EOL; // 向上 3 级目录

