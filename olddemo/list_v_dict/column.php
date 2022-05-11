<?php

$a = [
    [
        'a' => 123,
        'b' => 234,
    ],
    [
        'a' => 213,
    ],
    [
        'b' => 234,
    ]
];

$r = array_column($a, 'b');
var_export($r);