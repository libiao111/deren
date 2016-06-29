<?php
namespace Home\Controller;
use Think\Controller;
/**
* 用户端
*/

header('content-type:text/html;charset =utf-8');
class IndexController extends Controller
{
    public function index(){
        /*查询所有课程*/
    	$arr = D("course")->order('id')->select();
		$arr = node_merge($arr);
        $this->assign('course',$arr);
        $this->display();
    }
    /*线下课*/
    public function offLine(){
    	$arr = array(
    		'id'=>I('id')	
		);
        /*查询所有线下课*/
		$result = D("course")->where($arr)->order('id')->select();
		$this->assign('course',$result);
    	$this->display();
    }
    /*视频课*/
    public function video(){
    	if(IS_AJAX){
    		$this->error('页面不存在');die;
    	}
    	/*获取id*/
    	$arr = array(
    		'id'=>I('id')	
		);
        /*查询所有视频课*/
		$result = D("course")->where($arr)->order('id')->select();
		$this->assign('course',$result);
    	$this->display();
    }
    /*音频课*/
    public function voice(){
    	if(IS_AJAX){
    		$this->error('页面不存在');die;
    	}
    	/*获取id*/
    	$arr = array(
    		'id'=>I('id')	
		);
		/*查询所有音频课*/
		$result = D("course")->where($arr)->order('id')->select();
		$this->assign('course',$result);
    	$this->display();
    }
    /*课程详情*/
    public function details(){
    	if(IS_AJAX){
    		$this->error('页面不存在');die;
    	}
        $id = I('id');
    	$arr = array(
    		'id'=>I('id')
		);
        /*关联查询*/
		$result = D("course")->relation('bigpho')->where($arr)->order('id')->select();
        $result2 = D("course")->relation('class')->where($arr)->order('id')->select();
		$this->assign('course',$result);
        $this->assign('keshi',$result2);
    	$this->display();
    }
    /*订单表*/
    public function ordera(){
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
        $result = M('ordera'))->add($arr);
        /*返回状态*/
        if($result){
            $data = array('status'=>1);
        }else{
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
   }

}


















}
