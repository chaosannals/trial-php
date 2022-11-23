<?php

function test1()
{
    try {
        echo '2222';
        throw new Exception("4444444");
    } finally {
        // finally 会执行但是因为没有 catch ，异常无法在这层被捕获
        echo '1111';
    }
    echo '333'; // 不会执行
}

try {
    test1();
} catch (Throwable $t) {
    // 捕获异常
    echo $t->getMessage();
}
