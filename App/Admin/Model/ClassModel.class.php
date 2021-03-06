<?php
namespace Admin\Model;
use Think\Model\RelationModel;
/**
* 音频轮播图
*/
class ClassModel extends RelationModel
{
    protected $tableName = 'class';
    protected $_link = array(
        'class_img'=> array(
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'img',
            'foreign_key'  => 'class_id',
            'mapping_fields' => 'pho_url',
            'mapping_order' => 'id'
        )
    );
}
?>