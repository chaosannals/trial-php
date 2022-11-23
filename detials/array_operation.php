<?php

// array_diff
$a = ['a', 'b', 'a'];
$b = ['c', 'b', 'd', 'a'];
$c = array_diff($a, $b); // 空，结果必然是第一个参数里面的元素
$d = array_diff($b, $a); //[ 0 => 'c', 2 => 'd', ]
var_export($c);
var_export($d);

// 注：数组的很多方法都会导致序号不连续，
// 通过 array_values 重新获取连续的数组。
// array_unique 也会产生不连续数组。
$a = ['1','2','3'];
$b = ['2','3','4'];
var_export(array_values(array_diff($b, $a)));
var_export(array_unique(array_merge($a , $b)));

// null 用 [] 取值居然不会报错，得到的还是 null
$a = null;
var_export($a['aaa']);
var_export($a['aaa'] ?? 'bbbb');