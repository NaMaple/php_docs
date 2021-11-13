<?php

/**
 * Interface Segregation Principle
 *
 * 接口隔离原则（ISP）：客户端不应该依赖它不需要的接口；一个类对另一个类的依赖应该建立在最小接口上
 *
 * 一个类继承自一个 interface ，类里有的方法，接口要有，类里没有的方法，接口不需要
 */

interface Pro
{
    public function getProductName();

    public function getProductNum();

    // 接口也不应该有这个方法
//    public function getProductAccount();
}

interface Ord
{
    // 获取订单数量，单独提出来，放到订单接口里，让订单类去实现
    public function getProductAccount();
}

/*
 * 一个类接口一个接口，就要实现接口里的所有方法
 */
class Product implements Pro
{

    public function getProductName()
    {
        // TODO: Implement getProductName() method.
    }

    public function getProductNum()
    {
        // TODO: Implement getProductNum() method.
    }

    // 产品类里面不应该获取订单数量，违背了单一职责原则
    // 所以我们不应该有这个方法
//    public function getProductAccount()
//    {
//        // TODO: Implement getProductAccount() method.
//    }
}

class Order implements Ord
{

    public function getProductAccount()
    {
        // TODO: Implement getProductAccount() method.
    }
}
