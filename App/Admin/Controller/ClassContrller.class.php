<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
    
    public function index(){
        $result = M('class')=>select();
        $this->assign('class',$result);
        $this->display();
    }
    /*添加或修改课时*/
    public function addclass(){
    	$id = 2;
    	$class_name = 'sd';
        $class_time = 'sf';
        $course_id = 3;
        $class_mins ='dfg';
        $paixu = 2;
        $arr = array(
	       	'class_name'=>I('class_name')，
	       	'class_time'=>I('class_time'),
	       	'course_id'=>I('course_id'),
	       	'class_mins'=>I('class_mins'),
	       	'paixu'=>I('paixu')
       	);
       	$sql = M('course')->where(array('id'=>$course_id))->field('type')->find();
       	p($sql);
       	
    }

}