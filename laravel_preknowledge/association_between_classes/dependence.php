<?php

/**
 * Dependence，依赖关系
 * 只要在类中使用到了对方，他们之间就存在依赖关系
 *
 * 1.类的成员属性 todo
 * 2.方法的返回类型 todo
 * 3.方法接收的参数
 * 4.方法中直接使用
 *
 * 某个类的方法通过局部变量、方法的参数或者对静态方法的调用来访问另一个类（被依赖类）中的某些方法来完成一些职责
 */

class PersonServiceBean
{
    private $personDao;

    // 类的成员属性
    // PersonServiceBean成员属性使用了PersonDao类的实例
    public function __construct(PersonDao $personDao)
    {
        $this->personDao = $personDao;
    }

    // 方法的返回类型
    public function getIdCard($personId)
    {
        return new IdCard;
    }

    // 方法接收的参数
    public function save(Person $person) {}

    // 方法中直接使用
    public function modify()
    {
        $department = new Department;
    }
}

class PersonDao {}
class IdCard{}
class Person{}
class Department{}