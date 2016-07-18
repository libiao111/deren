<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class CourseModel extends RelationModel
{
	protected $tableName = 'class';
	protected $_link = array(
		
		'bigpho'=>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key'=>'class_id'
		)
	);
}

?>