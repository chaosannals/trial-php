<?php

// PHP 字典和数组统一成了数组
// 空数组（或字典）在json_encode 后都是 [] （空数组）
// 这个在对接强类型语言，例如 C# 时会通不过参数类型检查
echo '问题 ============='.PHP_EOL;
$a = '{ "a": {} }';
$b = json_decode($a, true);
$c = json_encode($b, JSON_UNESCAPED_UNICODE);
echo $a.' => '.$c.PHP_EOL;

// 此种方式会导致数组被强制转成对象，不适用。
echo 'JSON_FORCE_OBJECT ============='.PHP_EOL;
$v1 = [1,2,3, [4, 5, 6], ['a' => 1, 'b' => 'cc']];
echo json_encode($v1).PHP_EOL;
echo json_encode($v1, JSON_FORCE_OBJECT).PHP_EOL;

// 此种方式可以指定特定的对象变成关联数组，但是很麻烦，需要类型特别指定。
// PHP 缺少类型声明，这种相当于补上类型声明。
echo 'ArrayObject ============='.PHP_EOL;
$v2 = [new ArrayObject(), []];
echo json_encode($v2).PHP_EOL;
