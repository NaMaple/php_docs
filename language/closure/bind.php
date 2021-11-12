<?php

class A {
    private $a = 1;

    public function getA() {
        echo $this->a;
    }
}

class B {
    private $b = 1;

    public function getB() {
        echo $this->b;
    }
}

$closure = Closure::bind(function () {
//    echo 123;
    //
    echo $this->a;
}, null);

$closure();