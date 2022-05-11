<?php

// 大端
$a = pack('nNn', 0xA00A, 123456, 0x0AA0);
$c = pack('nNn', 0xA11A, 5145132, 0x1AA1);
$b = unpack("na/Nb/nc", "$a $c");
$d = unpack("na/Nb/nc", "$a $c", 9);
var_export($b);
var_export($d);