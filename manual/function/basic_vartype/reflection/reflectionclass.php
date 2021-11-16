<?php

/**
 * 反射机制就是可以利用类名或者一个类的对象来获取关于这个类的一系列信息（类的变量，方法），然后又就可以利用得到的类的信息实例化一些类的对象
 * 反射 API，有 对类、接口、函数、方法和扩展进行反向工程的能力。 此外，反射 API 提供了方法来取出函数、类和方法中的文档注释。
 */

include 'worker.php';
//通过类名获取反射对象
$workClass_by_classname = new ReflectionClass('Worker');
//var_dump($workClass_by_classname);die;

//    object(ReflectionClass)#1 (1) {
//    ["name"]=>
//      string(6) "Worker"
//    }


//通过类的实例对象获取反射对象
$w = new Worker("小明",20,20);
$workerClass_by_classinstance = new ReflectionObject($w);
//var_dump($workerClass_by_classinstance);die;

//    object(ReflectionObject)#3 (1) {
//    ["name"]=>
//      string(6) "Worker"
//    }


//因为ReflectionObject是ReflectionClass的子类，所以workClass_by_classname的方法，workerClass_by_classinstance同样适用
//下面利用workClass_by_classname对象获取类的一些属性

//获取类名
//echo $workClass_by_classname->getName() . PHP_EOL;

//    Worker

//获取类的方法列表
//var_dump($workClass_by_classname->getMethods());


//    array(3) {
//      [0]=>
//      object(ReflectionMethod)#4 (2) {
//        ["name"]=>
//        string(11) "__construct"
//        ["class"]=>
//        string(6) "Worker"
//      }
//      [1]=>
//      object(ReflectionMethod)#5 (2) {
//        ["name"]=>
//        string(4) "show"
//        ["class"]=>
//        string(6) "Worker"
//      }
//      [2]=>
//      object(ReflectionMethod)#6 (2) {
//        ["name"]=>
//        string(10) "__toString"
//        ["class"]=>
//        string(6) "Worker"
//      }
//    }


//获取类的属性
//var_dump($workClass_by_classname->getProperties());


//    array(3) {
//      [0]=>
//      object(ReflectionProperty)#6 (2) {
//        ["name"]=>
//        string(5) "name_"
//        ["class"]=>
//        string(6) "Worker"
//      }
//      [1]=>
//      object(ReflectionProperty)#5 (2) {
//        ["name"]=>
//        string(4) "age_"
//        ["class"]=>
//        string(6) "Worker"
//      }
//      [2]=>
//      object(ReflectionProperty)#4 (2) {
//        ["name"]=>
//        string(7) "salary_"
//        ["class"]=>
//        string(6) "Worker"
//      }
//    }

// 利用类名获得反射对象，并通过反射对象创建一个新的类实例
$worker = $workClass_by_classname->newInstance("小明",20,20);
//var_dump($worker);die;

// 通过类名和方法名得到反射对象
$show_method = new ReflectionMethod('Worker','show');
//var_dump($show_method);die;

// 并执行该方法
$show_method->invoke($worker);
//var_dump($show_method->invoke($worker));die;


// 利用反射机制得到属性，并设置值
$property = $workClass_by_classname->getProperty('name_');
// 得到属性
$property->setAccessible(true);
var_dump($property->getValue($worker));
// 设置值
$property->setValue($worker ,'小红');
var_dump($property->getValue($worker));
