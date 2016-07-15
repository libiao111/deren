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

    /*查询所有课程*/
    public function index()
    {   
        //获取用户id
        $users_id = session('user')['id'];
        // 查询课程表
        $course = M("course")->where()->order('id')->select();
        // 查询已支付订单
        $bills = M('ordera')->where(array('users_id' => $users_id, 'status' => 1))->field('course_id')->select();
        foreach ($course as $k => $kc) {
            $kc['status'] = 0;
            foreach ($bills as $dd) {
                if ($kc['id'] == $dd['course_id']) {
                    $kc['status'] = 1;
                }
            }
            $course[$k]=$kc;
        }
        $this->assign('course',$course);
        $this->display();
    }
    /*线下课*/
    public function offlinelist()
    {
        //获取用户id
        $users_id = session('user')['id'];
        /*查询所有线下课*/
        $where['type'] = 1;
        $result = M("course")->where($where)->order('id desc')->select();
        //查询已支付订单
        $bills = M('ordera')->where(array('users_id' => $users_id, 'status' => 1))->field('course_id')->select();
        foreach ($result as $k => $kc) {
            $kc['status'] = 0;
            foreach ($bills as $dd) {
                if ($kc['id'] == $dd['course_id']) {
                    $kc['status'] = 1;
                }
            }
            $result[$k]=$kc;
        }

        $this->assign('course',$result);
    	$this->display();
    }

    /*视频课*/
    public function videolist()
    {
    	//获取用户id
        $users_id = session('user')['id'];
        /*查询所有线下课*/
        $where['type'] = 2;
        $result = M("course")->where($where)->order('id desc')->select();
        //查询已支付订单
        $bills = M('ordera')->where(array('users_id' => $users_id, 'status' => 1))->field('course_id')->select();
        foreach ($result as $k => $kc) {
            $kc['status'] = 0;
            foreach ($bills as $dd) {
                if ($kc['id'] == $dd['course_id']) {
                    $kc['status'] = 1;
                }
            }
            $result[$k]=$kc;
        }

        $this->assign('course',$result);
        $this->display();
    }
    /*音频课*/
    public function audiolist()
    {
    	//获取用户id
        $users_id = session('user')['id'];
        /*查询所有线下课*/
        $where['type'] = 3;
        $result = M("course")->where($where)->order('id desc')->select();
        //查询已支付订单
        $bills = M('ordera')->where(array('users_id' => $users_id, 'status' => 1))->field('course_id')->select();
        foreach ($result as $k => $kc) {
            $kc['status'] = 0;
            foreach ($bills as $dd) {
                if ($kc['id'] == $dd['course_id']) {
                    $kc['status'] = 1;
                }
            }
            $result[$k]=$kc;
        }

        $this->assign('course',$result);
        $this->display();
    }
    /*线下课详情*/
    public function offline()
    {
    	//获取用户id
        $users_id = session('user')['id'];
        $id = I('id');
    	$arr = array(
    		'id'=>$id
		);
        $arr1 = array(
            'bigpho','class'
        );
        $arr2 = array(
            'course_id'=>$id,
            'users_id'=>$users_id
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->find();
        $bills = M('ordera')->where($arr2)->find();
        $result['status'] = $bills['status'] ? 1: 0;
        $this->assign('course',$result);
        $this->display();
    }
     /*视频课详情*/
    public function video()
    {
        //获取用户id
        $users_id = session('user')['id'];
        $id = I('id');
        $arr = array(
            'id'=>$id
        );
        $arr1 = array(
            'bigpho','class'
        );
        $arr2 = array(
            'course_id'=>$id,
            'users_id'=>$users_id
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->find();
        $bills = M('ordera')->where($arr2)->find();
        $result['status'] = $bills['status'] ? 1: 0;
        $this->assign('course',$result);
        $this->display();
    } 
    /*音频课详情*/
    public function audio()
    {
        //获取用户id
        $users_id = session('user')['id'];
        $id = I('id');
        $arr = array(
            'id'=>$id
        );
        $arr1 = array(
            'bigpho','class'
        );
        $arr2 = array(
            'course_id'=>$id,
            'users_id'=>$users_id
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->find();
        $bills = M('ordera')->where($arr2)->find();
        $result['status'] = $bills['status'] ? 1: 0;
        $this->assign('course',$result);
        $this->display();
    }
    /*确认订单*/
    public function order()
    {   
        $id = I('id');
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
        $users_id = session('user')['id'];
        /*以id= course_id查询课程表*/
        $sql = M('course')->where(array('id'=>2))->field('id','course_name','current_price')->find();
        /*生成订单号*/
        $time = time();
        $str = rand('1000','9999');
        $ordera_num = 'DR'.$time.$str;
        /*数组赋值订单表*/
        $arr = array(
            'ordera_name' => I('ordera_name'),
            'ordera_mobi' => I('order_mobi'),
            'course_id' => I('course_id'),
            'users_id' => $users_id,
            'status' => 0,
            'ordera_num' => $ordera_num,
            'pay_type' => I('radio1')
        );
        $result = M('ordera')->add($arr);
        /*传递到支付数组*/
        $arr1 = array(
            'sign'      => '[德仁商学院]',
            'title'     => $sql['course_name'],
            'bills'     => $ordera_num,
            'price'     => $sql['current_price'],
            'realm'      => 'http://www.gkdao.com/temps/heroslider/deren',
            'successurl' => U('gotocourse')
        );
        session('arr',$arr1);
        redirect(U("Pay/Index/index"));
    }




}

