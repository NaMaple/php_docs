<?php
/**
 * Composite Reuse Principle
 * 合成复用原则|共同重用原则（CRP）
 *
 * 视频定义：在软件复用时，要尽量先使用组合或者聚合等关联关系来实现，其次才考虑继承关系来实现。如果要使用继承关系，则必须严格遵循里氏替换原则。
 *
 * 敏捷软件开发：一个包中的所有类应该是共同重用的，如果重用了包中的一个类，那么就要重用包中的所有类。
 *
 * todo 关联关系 UML相关知识
 *
 * UML类图与类的关系详解
 * https://www.cnblogs.com/pangjianxin/p/7877868.html
 * 泛化，实现，组合，聚合，关联，依赖
 */

class A
{
    public function get()
    {

    }
}

/*
 * B类想使用A类的get()方法
 * 1.使用继承，class B extends A，加大了耦合，能不使用就不使用
 */
class B
{
    protected $a;

    // 把A聚合到B类来
    public function __construct(A $a)
    {
        $this->a = $a;
        $a->get();
    }
}