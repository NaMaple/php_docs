<?php

/*
 * scope
 */
//$a = 1; /* global scope */
//function Test() {
//    echo $a; /* reference to local scope variable */
//}
//Test();


/*
 * global
 */
//$a = 1;
//$b = 2;
//function Sum() {
//    global $a, $b; //只是为了传参
//    $b = $a + $b;
//}
//Sum();
//echo $b;


/*
 * $GLOBALS[index]
 */
//$name = 'maple';
//$age = 24;
//$city = 'beijing';
//
//function index(){
//    echo 'name:'.$GLOBALS['name'].'; age:'.$GLOBALS['age'].'; city:'.$GLOBALS['city'];
//    var_dump($GLOBALS);
//}
//index();


/*
 * static
 */
function test_static() {
    static $a = 0;
    echo $a;
    $a++;
}
test_static();
test_static();
test_static();
test_static();