<?php

$a = 1234.1254;
$b = 1234.125;
// 四舍五入
echo round($a, 2, PHP_ROUND_HALF_DOWN).PHP_EOL; // 1234.13 位数够一致
echo round($a, 2, PHP_ROUND_HALF_UP).PHP_EOL; // 1234.13 位数够一致
echo round($b, 2, PHP_ROUND_HALF_DOWN).PHP_EOL; // 1234.12 末位刚好是 5 向下取
echo round($b, 2, PHP_ROUND_HALF_UP).PHP_EOL; // 1234.13 末位刚好是 5 向上取

// 这个函数慎用，最好就不要用。
// 因为内部是DOUBLE实现，大数时，即使结果是整数也会精度出错。
$e = 160551224820511111;
//   160551224820511104
echo number_format(160551224820511111, 0, '', '').PHP_EOL;
