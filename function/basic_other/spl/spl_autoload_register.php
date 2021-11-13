<?php

function my_autoloader($class) {
    var_dump('classes/' . $class . '.class.php');
    include 'classes/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');

// 实例化一个未定义的类时，就会触发此函数spl_autoload_register，调用my_autoloader方法，$class就是类名
$helper = new helper();
$helper->index();