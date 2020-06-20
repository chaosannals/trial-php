<?php

$a = ['a', 'b', 123, '132'];
$b = ['a', '132'];

$r = array_diff($a, $b);
var_export($r);
