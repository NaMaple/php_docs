<?php
/**
 * Open Closed Principle
 *
 * 开闭原则（OCP） 软件中的对象（类、模块、函数等等）应该对于扩展是开发的，但是对于修改是封闭的。这意味着一个实体是允许在不改变它的源代码的前提下变更它的行为
 *
 */

interface Mail
{
    public function sendMail();
}

class Qq implements Mail
{
    public function sendMail()
    {
        //todo
    }
}

class Foxmail implements Mail
{
    public function sendMail()
    {
        //todo
    }
}

/**
 * Class People
 * 行为
 * 当我们从QQ转向Foxmail，这段代码没有修改
 */
class People
{
    public function send(Mail $mail)
    {
        $mail->sendMail();
    }
}

$people = new People();
// 传递类型进去，类似简单工厂模式
$people->send(new Qq());
$people->send(new Foxmail());