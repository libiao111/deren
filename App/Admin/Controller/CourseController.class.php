<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
    
     public function index(){
        /*查询所有课程*/
    	$arr = M("course")->where(array('id'=>1))->order('id')->find();
    	$arr = M("course")->order('id')->select();
    	p($arr);
        $this->assign('course',$arr);
        
    }

}