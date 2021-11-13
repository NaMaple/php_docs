<?php
/**
 * Liskov Substitution Principle
 *
 * 里氏替换原则（LSP）一个抽象的任意实现都可以在声明该抽象的地方替换它
 *
 * 子类在继承父类的时候，尽量不要重写父类的方法
 */

class Product
{
    public function getPrice()
    {
        echo '返回产品的价格' . PHP_EOL;
    }
}

class SubProduct extends Product
{
    public function getPrice()
    {
        // 重写了父类的方法，违背了里氏替换原则
//        parent::getPrice();
        echo '返回订单的价格' . PHP_EOL;
    }
}

$obj = new Product();
$obj->getPrice(); // 返回产品的价格

$obj = new SubProduct();
$obj->getPrice(); // 返回订单的价格