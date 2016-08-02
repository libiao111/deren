<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CourseModel extends RelationModel
{
	protected $tableName = 'course';
	protected $_link = array(
		'class'=>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key'=>'course_id'
		)
	);
}

?>