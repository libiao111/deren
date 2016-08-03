<?php
namespace Admin\Model;
use Think\Model\RelationModel;
/**
* 订单关联
*/
class BillsModel extends RelationModel
{
    protected $tableName = 'bills';
    protected $_link = array(
        'course' => array(
            'mapping_type' => self::BELONGS_TO,
            'foreign_key'  => 'course_id',
            'mapping_fields' => 'course_photo'
        )
    );
}