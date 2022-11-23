<?php

// strlen 是字节数，不是字符数。
echo strlen('中文13').PHP_EOL; // 8

// 0 ASCII 字符是控制码，显示不出来，但是占长度。
// 20 ASCII 字符是空格
$b = "aaaa\x00\x20cc\x00\x20bbbbb";
$b = substr($b, 8, 32);
echo $b.' '.strlen($b).PHP_EOL; // bbbbb 7