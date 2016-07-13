<?php
namespace Admin\Controller;
use Think\Controller;
/*
* 管理端
*/
class ClassController extends Controller
{
    /*默认显示所有课时*/
    public function index(){
        $result = M('class')->select();
        $this->assign('class',$result);
        $this->display();
    }
    /*添加或修改课时*/
    public function addClass(){
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
	    $id = I('id');
    	$class_time = I('class_time');
        $class_mins =I('class_mins');
        $arr = array(
	       	'class_name'=>I('class_name'),
	       	'course_id'=>I('course_id'),
	       	'paixu'=>I('paixu')
       	);
        $arr = array(
            'class_name'  =>3,
            'course_id'   =>5,
            'paixu'   =>2
        );
       	if($id){
            //修改操作
            $arr[id]=$id;
            $arr['class_time']=$class_time;
            $result = M('class')->save($arr);
        }
        else{
            //添加操作
            $arr['class_mins']=$class_mins;
            $result = M('class')->add($arr);
        }
        if($result){
            $data = array('status'=>1);
        } 
        else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data',json);
       	
    }
    //删除课时
    public function deleteClass(){
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
        $id = I('id');
        $arr = array(
            'id'=>$id
        )
        $result = M('class')->where($arr)->delete();
        if($result){
            $data = array('status'=>1);
        } 
        else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data',json);
    }

}