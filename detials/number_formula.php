<?php

$fraw = "round((【变量1】 + 【变量2】) / 【变量3】, 【小数点位】,【舍入方式】)";

function make_f($fraw, $round=PHP_ROUND_HALF_DOWN) {
    $f = "\$result = $fraw;";
    return str_replace([
        "【变量1】",
        "【变量2】",
        "【变量3】",
        "【变量4】",
        "【舍入方式】",
        "【小数点位】",
    ], [
        "\$v1",
        "\$v2",
        "\$v3",
        "\$v4",
        $round,
        "\$scale",
    ], $f);
}

function get_price($f, $data)
{
    extract($data);
    eval($f);
    return $result;
}

$f = make_f($fraw);
echo $f.PHP_EOL;

echo get_price($f, [
    "v1" => 100,
    'v2' => 99.1256,
    'v3' => 10,
    'scale' => 2
]);
