<?php

$a = [];  // 数据，1000个。
for($i = 0; $i < 1000; $i++) {
    $a[] = $i;
}
$c = count($a);  // 数据总个数（int32个数，不是字节数）
$h = 0xFF000000; // 槽位掩码
$s = $h + 1;     // 槽位号 + 掩码
$data = pack("V*", $s, $c, ...$a); // 打包
echo bin2hex($data); // 数据显示 HEX

file_put_contents('a.bin', $data); // 数据输出文件
