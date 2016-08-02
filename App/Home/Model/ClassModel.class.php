<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ClassModel extends RelationModel
{
	protected $tableName = 'class';
	protected $_link = array(
		'class_img'=> array(
			'mapping_type' => self::HAS_MANY,
			'mapping_name' => 'img',
			'foreign_key'  => 'class_id'
		)
	);
}
?>