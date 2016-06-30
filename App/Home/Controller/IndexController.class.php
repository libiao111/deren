<?php
namespace Home\Controller;
use Think\Controller;
/**
* 用户端
*/
class IndexController extends Controller
{
    public function index()
    {
        /*查询所有课程*/
    	$arr = D("course")->order('id')->select();
        $this->assign('course',$arr);
        $this->display();
    }
    /*线下课*/
    public function offline()
    {
        $arr = array(
    		'type'=>1
		);
        /*查询所有线下课*/
		$result = D("course")->where($arr)->order('id desc')->select();
        $this->assign('course',$result);
    	$this->display();
    }
    /*视频课*/
    public function video()
    {
    	$arr = array(
    		'type'=>2
		);
        /*查询所有视频课*/
		$result = D("course")->where($arr)->order('id desc')->select();
		$this->assign('course',$result);
    	$this->display();
    }
    /*音频课*/
    public function voice()
    {
    	$arr = array(
    		'type'=>3
		);
		/*查询所有音频课*/
		$result = D("course")->where($arr)->order('id desc')->select();
		$this->assign('course',$result);
    	$this->display();
    }
    /*线下课详情*/
    public function offlinedetails()
    {
    	$id = I('id');
    	$arr = array(
    		'id'=>$id
		);
        $arr1 = array(
            'bigpho','class'
        );
        /*关联查询*/
		$result = D("course")->relation($arr1)->where($arr)->order('id')->select();
        $this->assign('course',$result);
        $this->display();
    }
     /*视频课详情*/
    public function videodetails()
    {
        $id = I('id');
        $arr = array(
            'id'=>$id
        );
        $arr1 = array(
            'bigpho','class'
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->order('id')->select();
        $this->assign('course',$result);
        $this->display();
    } 
    /*音频课详情*/
    public function voicedetails()
    {
        $id = I('id');
        $arr = array(
            'id'=>$id
        );
        $arr1 = array(
            'bigpho','class'
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->order('id')->select();
        $this->assign('course',$result);
        $this->display();
    }
    /*订单表*/
    public function ordera()
    {
        if(IS_AJAX){
            $this->error('页面不存在');die;
        }
        /*获取数据*/
        $ordera_name  = I('ordera_name');
        $order_mobi = I('order_mobi');
        $course_id = I('course_id');
        $user_id = I('user_id');
        /*数组赋值*/
        $arr = array(
            'ordera_name' =>$ordera_name,
            'order_mobi' =>$order_mobi,
            'course_id' =>$course_id,
            'user_id' =>$user_id,
            'ordera_status'=>1

        );
        $result = M('ordera')->add($arr);
        /*返回状态*/
        if($result){
            $data = array('status'=>1);
        }else{
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
   }




}

