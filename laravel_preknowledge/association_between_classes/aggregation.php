<?php

/**
 * Aggregation
 * 聚合是关联关系的特例，表示的是整体和部分的关系，整体与部分可以分开
 */


/**
 * 学生类
 */
class Pupil
{
    public $name;
}

/**
 * 班级类
 */
class SchoolClass
{
    private $_students = array();

    /**
     * 添加学生
     */
    public function addPupil(Pupil $student)
    {
        $this->_students[] = $student;
    }
}