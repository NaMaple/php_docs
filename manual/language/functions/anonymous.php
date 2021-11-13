<?php
/**
 * 匿名函数
 */

// 普通函数
function demo() {
    echo '我是普通函数' . PHP_EOL;
}
//demo();

// 匿名函数
//function (){
//    echo '我是匿名函数';
//}
// 匿名函数不能直接调用，因为不属于正常函数的格式

// 匿名函数的调用
$test = function () {
    echo '我是匿名函数';
};
// 需要配合变量函数调用，给匿名函数赋值，变量就有名字了
//$test();

/**
 * 闭包函数
 * 使用use关键字，使用父函数的变量
 */
$var = '这是一个全局变量';

//function father() {
//    // 父函数的一个局部变量
//    $var = '这是一个父函数的局部变量';
//    function son() {
//        global $var;
//        echo $var;
//    }
//    son();
//}
//father();

// 使用匿名函数的方式实现闭包
function father(){
    $var = '这是一个父函数的局部变量';
    $son = function () use($var){
        echo $var;
    };
    $son();
}
//father();


/*
 * https://www.php.net/manual/zh/functions.anonymous.php
 */
$message = 'hello';

// 没有use
$example = function () {
    var_dump($message);
};
$example();

// 继承 $message
$example = function () use ($message) {
    var_dump($message);
};
$example();


