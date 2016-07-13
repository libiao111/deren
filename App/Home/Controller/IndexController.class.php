<?php
namespace Home\Controller;
use Think\Controller;
/**
* 用户端
*/
class IndexController extends Controller
{

    public function _initialize() {
        $this->login = session('user') ? 1: 0;
        $this->user_content = session('user');
    }

    public function index()
    {
        /*查询所有课程*/
    	$arr = M("course")->order('id')->select();
        $this->assign('course',$arr);
        $this->display();
    }
    /*线下课*/
    public function offlinelist()
    {
        $arr = array(
    		'type'=>1
		);
        /*查询所有线下课*/
		$result = M("course")->where($arr)->order('id desc')->select();
        $this->assign('course',$result);
    	$this->display();
    }
    /*视频课*/
    public function videolist()
    {
    	$arr = array(
    		'type'=>2
		);
        /*查询所有视频课*/
		$result = M("course")->where($arr)->order('id desc')->select();
		$this->assign('course',$result);
    	$this->display();
    }
    /*音频课*/
    public function audiolist()
    {
    	$arr = array(
    		'type'=>3
		);
		/*查询所有音频课*/
		$result = M("course")->where($arr)->order('id desc')->select();
		$this->assign('course',$result);
        $this->display();
    }
    /*线下课详情*/
    public function offline()
    {
    	$id = I('id');
    	$arr = array(
    		'id'=>$id
		);
        $arr1 = array(
            'bigpho','class'
        );
        /*关联查询*/
		$result = D("course")->relation($arr1)->where($arr)->order('id')->find();
        $this->assign('course',$result);
        $this->display();
    }
     /*视频课详情*/
    public function video()
    {
        $id = I('id');
        $arr = array(
            'id'=>$id
        );
        $arr1 = array(
            'bigpho','class'
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->order('id')->find();
        $this->assign('course',$result);
        $this->display();
    } 
    /*音频课详情*/
    public function audio()
    {
        $id = I('id');
        $arr = array(
            'id'=>$id
        );
        $arr1 = array(
            'bigpho','class'
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->order('id')->find();
        $this->assign('course',$result);
        $this->display();
    }
    /*确认订单*/
    public function order()
    {   $id = I('id');
        $arr = array(
            'id'=>$id
        );
        $result = M('course')->where($arr)->find();
        $this->assign('course',$result);
        $this->display();
    }
    /*订单表*/
    public function ordera()
    {
        /*获取数据*/
        $user_id = session('id');
        //生成订单号
        $time = time();
        $str = rand('1000','9999');
        $ordera_num = 'Deren'.$time.$str;
        //数组赋值
        
        $arr = array(
            'ordera_name' =>I('ordera_name'),
            'order_mobi' =>I('order_mobi'),
            'course_id' =>I('course_id'),
            'user_id' =>$user_id,
            'status'=>1,
            'ordera_num'=>$ordera_num,
            'pay_type' =>I('pay_type'),
            'sign'=>I('sign'),
            'current_price' => I('current_price')
        );
        /*$arr1 = array(
            'title' =>I('ordera_name'),
            'bills'=>$order_num,
            'pay_type' =>I('pay_type'),
            'proce' => I('current_price'),
            'sign'=>I('sign'),
            'realm'=>3,
            'successurl'=>4
        );*/
        $arr1 = array(
            'title' =>4,
            'bills'=>$ordera_num,
            'pay_type' =>8,
            'price' => 9,
            'sign'=>56,
            'realm'=>3,
            'successurl'=>4
        );
        redirect(U("Pay/Index/index",$arr1));
        //$result = M('ordera')->add($arr);
    }




}

