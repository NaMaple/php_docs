<?php

/**
 * Implementation
 * 实现
 *
 * A类实现B类，是泛化的特例
 */


interface Chargeable
{
    public function getPrice();
}

class ShopProduct implements Chargeable
{
    private $price;
    private $discount;

    // ...
    public function getPrice()
    {
        return $this->price - $this->discount;
    }
    // ...
}

class CDProduct extends ShopProduct{}

class BookProduct extends ShopProduct{}