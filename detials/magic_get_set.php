<?php

/**
 * 魔术方法 __get __set 可以通过以下方式让外部通过 -> 操作符访问属性
 * 私有成员不与 __get __set 冲突。
 */
class Test
{
    private $data = [];
    private $origin = "private origin";

    public function __set($name, $v)
    {
        $this->data["aaa_$name"] = $v;
    }

    function __get($name)
    {
        return $this->data["aaa_$name"];
    }

    function printOrigin() {
        echo $this->origin;
    }
}

$t = new Test();
$t->origin = 'origin'; // 通过 __set 设置 origin 新值，不是类内私有的 origin
echo $t->origin.PHP_EOL; // 通过 __get 获取 origin
$t->printOrigin(); // 答应 private origin
