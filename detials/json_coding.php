<?php

// PHP 字典和数组统一成了数组
// 空数组（或字典）在json_encode 后都是 [] （空数组）
// 这个在对接强类型语言，例如 C# 时会通不过参数类型检查
$a = '{ "a": {} }';
$b = json_decode($a, true);
$c = json_encode($b, JSON_UNESCAPED_UNICODE);
echo $c;

