<?php

$text = "中文字符ASBDSFADSF2#$!@#";

var_export($text[0].$text[1].$text[2]); // 中
var_export($text[3].$text[4].$text[5]); // 文

$text[6] = 'a';
$text[7] = 'b';
$text[8] = 'c';
$text[9] = chr(0b11100000);
var_export($text);