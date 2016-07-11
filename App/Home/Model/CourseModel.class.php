<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CourseModel extends RelationModel
{
	protected $tableName = 'course';
	protected $_link = array(
		'ordera'=>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key'=>'course_id'
		),
		'class'=>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key'=>'course_id_ccc'
		),
		'class_sds'=>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key'=>'course_id_ccc'
		)
		
	);
}

?>