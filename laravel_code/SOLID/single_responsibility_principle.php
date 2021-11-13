<?php

/**
 * https://www.jianshu.com/p/3268264ae581
 *
 * 六大设计原则，最终达到的目的：低耦合，高内聚，易维护，可扩展
 * 设计模式都是基于六大设计原则引申出来的
 *
 * Single Responsibility Principle
 *
 * 单一职责原则(SRP)：每个类都应该只有自己单一的职责
 *
 * 自己干自己的，就干一件事
 */

/**
 * Class Product
 * 本来只能获得和产品相关的名字和价格
 * 现在多了一个订单相关的信息
 */
class Product
{
    public function getName()
    {
        //todo
    }

    public function getPrice()
    {

    }

    // 获取某个订单的价格
    // 违法了单一职责原则
//    public function getAccount()
//    {
//
//    }
}

/**
 * Class Order
 * 新定义订单类，把订单相关的方法，移到 Order 类中
 */
class order
{
    // 获取某个订单的价格
    public function getAccount()
    {

    }

    public function getPriceNew()
    {

    }
}