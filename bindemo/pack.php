<?php

$a = [];
for($i = 0; $i < 1000; $i++) {
    $a[] = $i;
}
$c = count($a);
$slotName = "slot1:";
// $slotName = "";
$data = pack("vV*", $c, ...$a);
$result = "{$slotName}{$data}";
echo bin2hex($result);