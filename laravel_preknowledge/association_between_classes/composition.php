<?php

/**
 * Composition
 * 组合也是整体与部分的关系，但是整体与部分不可以分开。强聚合。
 */


/**
 * 社保数据
 */
class SocialSecurityData
{
}

/**
 * 自然人
 */
class Person
{
    public SocialSecurityData $p_social_security_data;

    /**
     * 获取人的信息
     */
    public function getPerson($person_id)
    {
        //...
        $p_social_security_data = new SocialSecurityData($person_id);
        // ...
    }
}