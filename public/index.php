<?php

phpext_test1();
// phpinfo();
$tester = new Tester();
var_export($tester->memory);
$tester->test("aaaaa");
// var_export($tester->memory);

echo "<br/>";

class A
{
    function test()
    {
        echo 'atetset';
    }
}

$a = new A();
$a->test();
