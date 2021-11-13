<?php

/**
 * Law of Demeter | Least Knowledeg Principle
 * 迪米特原则（LKP）| 最少知道原则
 *
 * 只和你的朋友关联，不要和陌生人联系
 * 这里朋友指的是：当前对象本身，成员变量，成员方法，即一个对象应该对其他对象有最少的了解，减少类里面的冗余的类
 *
 */

/**
 * 产品和商店是朋友关系，产品和服务员、和顾客是非朋友关系
 */
class Product
{
    public function getProduct()
    {
        return 'apple';
    }
}

/*
 * 服务员
 */
class Waiter
{
    public function getWaiter()
    {
        return 'W Tom';
    }
}

/**
 * 顾客
 */
class Customer
{
    public function getCustomer()
    {
        return 'C Yin';
    }
}

/*
 * 商店，产品只和商店是朋友关系，只和商店联系
 */
class Shop
{
    private $product;
    private $waiter;
    private $customer;

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function setWaiter(Waiter $waiter)
    {
        $this->waiter = $waiter;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    // 商品售卖
    public function Shopping()
    {
        echo $this->waiter->getWaiter().'将产品'.$this->product->getProduct().'卖给了'.$this->customer->getCustomer();
    }

    // 商品寄售
    public function Consignment()
    {
        echo $this->customer->getCustomer().'将产品'.$this->product->getProduct().'通过'.$this->waiter->getWaiter().'进行寄售';
    }

    // 商品暂存
    public function TemStorage()
    {
        echo $this->customer->getCustomer().'通过'.$this->product->getProduct().'将产品'.$this->waiter->getWaiter().'暂存起来';
    }
}

