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

// 第二个参数用来指定 $this 的范围s
// 第三个参数用来指定作用域
$closure = Closure::bind(function () {
//    echo 123;
    // 无法识别 $this
    echo $this->b . PHP_EOL;
    echo $this->name . PHP_EOL;
}, new B());

$closure();