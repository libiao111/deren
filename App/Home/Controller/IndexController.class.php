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
    	$arr = D("course")->relation('ordera')->order('id')->select();
        foreach ($arr as $k => $v) {
            foreach ($v as $ke => $va) {
                foreach ($va as $key => $val) {
                $v['status']=$val['status'];
                   //p($v); 
                }
             }
             $arr[$k]=$v;
        }
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
		$result = D("course")->relation('ordera')->where($arr)->order('id desc')->select();
        foreach ($result as $k => $v) {
            foreach ($v as $ke => $va) {
                foreach ($va as $key => $val) {
                $v['status']=$val['status'];
                   //p($v); 
                }
             }
             $result[$k]=$v;
        }
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
		$result = D("course")->relation('ordera')->where($arr)->order('id desc')->select();
        foreach ($result as $k => $v) {
            foreach ($v as $ke => $va) {
                foreach ($va as $key => $val) {
                $v['status']=$val['status'];
                   //p($v); 
                }
             }
             $result[$k]=$v;
        }
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
		$result = D("course")->relation('ordera')->where($arr)->order('id desc')->select();
        foreach ($result as $k => $v) {
            foreach ($v as $ke => $va) {
                foreach ($va as $key => $val) {
                    $v['status']=$val['status'];
                }
             }
             $result[$k]=$v;
        }
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
            'bigpho','class','ordera'
        );
        /*关联查询*/
		$result = D("course")->relation($arr1)->where($arr)->order('id')->find();
        foreach ($result as $k => $v) {
            foreach ($v as $ke => $va) {
               $result['status']=$va['status'];
             }
        }
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
            'bigpho','class','ordera'
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->order('id')->find();
        foreach ($result as $k => $v) {
            foreach ($v as $ke => $va) {
                $result['status']=$va['status'];
             }
        }
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
            'bigpho','class','ordera'
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->order('id')->find();
        foreach ($result as $k => $v) {
            foreach ($v as $ke => $va) {
                $result['status']=$va['status'];
             }
        }
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
        /*以id= course_id查询课程表*/
        $sql = M('course')->where(array('id'=>2))->field('id','course_name','current_price')->find();
        /*生成订单号*/
        $time = time();
        $str = rand('1000','9999');
        $ordera_num = 'Deren'.$time.$str;
        /*数组赋值订单表*/
        $arr = array(
            'ordera_name' =>I('ordera_name'),
            'order_mobi' =>I('order_mobi'),
            'course_id' =>I('course_id'),
            'user_id' =>$user_id,
            'status'=>1,
            'ordera_num'=>$ordera_num,
            'pay_type' =>I('pay_type'),
        );
        $result = M('ordera')->add($arr);
        /*传递到支付数组*/
        $arr1 = array(
            'sign'=>'德仁商学院',
            'title' =>$sql['course_name'],
            'bills'=>$ordera_num,
            'price' =>$sql['current_price'],
            'realm'=>'http://gkdao.com/temps/heroslider/deren',
            'successurl'=>'http://gkdao.com/temps/heroslider/deren/index.php/Home/Index/gotocourse'
        );
        session('arr',$arr1);
        redirect(U("Pay/Index/index"));
    }




}

