<?php
/**
 * Dependence Inversion Principle
 *
 * 依赖倒置原则（DIP） 高层模块不应该依赖于低层模块，二者都应该于抽象（interface）。进一步来说，抽象不应该依赖于细节，细节应该依赖于抽象
 *
 * 什么是高层，低层模块
 *
 */

/**
 * 发送邮件
 * 低层模块
 */

//class Qq
//{
//    public function sendMail()
//    {
//        //todo
//    }
//}
//
///**
// * Class Foxmail
// * 当多了一种Foxmail发送方式后，高层模块需要修改代码
// *
// */
//class Foxmail
//{
//    public function sendMail()
//    {
//        //todo
//    }
//}
//
///**
// * 高层模块
// */
//class People
//{
//    // 高层模块依赖于低层模块，People 类依赖于 Qq 类
////    public function send(Qq $qq)
////    {
////        $qq->sendMail();
////    }
//    public function send(Foxmail $foxmail)
//    {
//        $foxmail->sendMail();
//    }
//}
//
//// 其实这种依赖可以用依赖注入解决
//$people = new People();
////$people->send(new Qq());
//// 耦合性太大，不易维护代码
//$people->send(new Foxmail());


// 增加一个接口
interface Mail
{
    public function sendMail();
}

class Qq implements Mail
{
    public function sendMail()
    {
        // 发送邮件逻辑
    }
}

class Foxmail implements Mail
{
    public function sendMail()
    {
        // 发送邮件逻辑
    }
}

class People
{
    public function send(Mail $mail)
    {
        $mail->sendMail();
    }
}

$people = new People();
// todo 传递类型进去，类似简单工厂模式
$people->send(new Qq());
$people->send(new Foxmail());