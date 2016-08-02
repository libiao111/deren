<?php
namespace Admin\Model;
use Think\Model\RelationModel;
/**
* 课程关联
*/
class CourseModel extends RelationModel
{
    protected $tableName = 'course';
    protected $_link = array(
        'class' => array(
            'mapping_type' => self::HAS_MANY,
            'foreign_key'  => 'course_id'
        ),
        'class_img' => array(
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'img',
            'foreign_key'  => 'course_id'
        )
    );
}