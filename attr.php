<?php

interface I1 {
    public function say();
}

#[Attribute(Attribute::TARGET_ALL)]
class A1 implements I1 {
    public function say() {
        echo 'A';
    }
}

#[Attribute(Attribute::TARGET_ALL)]
class B2 extends A1 {
    public function say() {
        echo 'B';
    }
}


#[A1]
#[B2]
class Test {}

$r = new ReflectionClass(Test::class);
foreach ($r->getAttributes('A1') as $i) {
    $i->newInstance()->say();
}
