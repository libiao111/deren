<?php
namespace Home\Controller;
use Think\Controller;
/**
* 用户端
*/
class IndexController extends Controller
{
    // init check
    public function _initialize()
    {
        /* 关注公众号 */
<<<<<<< HEAD
        /*$openid = session('openid');
        if (count($openid) == 0) {
            $openid = getOpenID();
            if ($openid['status'] == 0) {
                $this->redirect('Open/index');
            }
        }*/
=======
        // $openid = session('openid');
        // if (count($openid) == 0) {
        //     $openid = getOpenID();
        //     if ($openid['status'] == 0) {
        //         $this->redirect('Open/index');
        //     }
        // }
>>>>>>> d7a3cd3d654f93481ef75ca6883fcc025dc56d90

        /* 登录验证 */
        $user = session('user');
        if (isset($user['id']) && isset($user['user_mobi'])) {
            $this->assign('login', 1);
            $this->assign('user_content', $user);
        } else {
            $this->assign('login', 0);
            $this->assign('user_content', array());
        }
    }

    /* 登录页面 */
    public function login()
    {
        $this->display();
    }

    /* ----------------------------------列表-------------------------------- */
    /* ----------------------------------列表-------------------------------- */
    /* ----------------------------------列表-------------------------------- */

    /*查询所有课程*/
    public function index()
    {   
        //获取用户id
        $users_id = session('user')['id'];
        // 查询课程表
        $course = M("course")->where()->order('id')->select();
        // 查询已支付订单
        $bills = M('bills')->where(array('users_id' => $users_id, 'status' => 1))->field('course_id')->select();
        foreach ($course as $k => $kc) {
            $kc['status'] = 0;
            if ($kc['type'] == 1) {
                $kc['class_time'] = date('m-d', strtotime($kc['class_time']));
            }
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
        $bills = M('bills')->where(array('users_id' => $users_id, 'status' => 1))->field('course_id')->select();
        foreach ($result as $k => $kc) {
            $kc['status'] = 0;
            $kc['class_time'] = date('m-d', strtotime($kc['class_time']));
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
        $bills = M('bills')->where(array('users_id' => $users_id, 'status' => 1))->field('course_id')->select();
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
        $bills = M('bills')->where(array('users_id' => $users_id, 'status' => 1))->field('course_id')->select();
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

    /* ----------------------------------详情-------------------------------- */
    /* ----------------------------------详情-------------------------------- */
    /* ----------------------------------详情-------------------------------- */

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
            'class'
        );
        $arr2 = array(
            'course_id'=>$id,
            'users_id'=>$users_id
        );
        /*关联查询*/
        $result = D("course")->relation($arr1)->where($arr)->find();
        $bills = M('bills')->where($arr2)->find();
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

        /*关联查询*/
        $field = 'id,course_photo,course_name,teach_name,current_price,course_price,picture';
        $result = D("course")->relation('class')->where(array('id' => $id))->field($field)->find();

        $arr2 = array(
            'course_id' => $id,
            'users_id' => $users_id
        );
        $bills = M('bills')->where($arr2)->find();

        $result['status'] = $bills['status'] ? 1: 0;

        $this->assign('course',$result);
        $this->display();
    } 
    /*音频课详情*/
    public function audio()
    {
        //获取用户id
        $users_id = session('user')['id'];
        /*获取课程id*/
        $id = I('id');
        $arr = array(
            
        );
        $arr2 = array(
            'course_id' => $id,
            'users_id'=>$users_id
        );
        
        /*关联查询课程表*/
        $result = M("course")->where(array('id' => $id))->find();
        $result['class'] = D("class")->relation('img')->where(array('course_id' => $id))->select();
        /*赋值*/
        $result['bigpho']=$arr4;
        /*查询订单表*/
        $bills = M('bills')->where($arr2)->find();
        /*判断是否购买*/
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

    /* ----------------------------------订单-------------------------------- */
    /* ----------------------------------订单-------------------------------- */
    /* ----------------------------------订单-------------------------------- */

    /*订单表*/
    public function ordera()
    {   
        $user_id = session('user')['id'];
        $id = I('course_id');
        
        /* 课程信息 */
        $filed = 'course_name,current_price,type';
        $course = M('course')->where(array('id' => $id))->field($filed)->find();
        
        /*生成订单号*/
        $ordera_num = 'DRKC'.time().rand('1000','9999');
        
        /* 订单信息 */
        $arr = array(
            'users_id'      => $user_id,
            'course_id'     => I('course_id'),
            'order_num'     => $ordera_num,
            'user_name'     => I('user_name'),
            'user_phone'    => I('user_phone'),
            'course_price'  => $course['current_price'],
            'pay_type'      => I('pay_type'),
            'status'        => 0
        );
        $result = M('bills')->add($arr);

        /* 支付信息 */
        $data = array(
            'id'    =>$course['id'],
            'sign'  => '[德仁商学院]',              // 签名
            'bills' => $ordera_num,                 // 订单号
            'title' => $course['course_name'],      // 商品名
            'price' => $course['current_price'],    // 支付价格
            'type'  => $course['type'],      // 课程类型
            'realm'      => 'http://www.gkdao.com/temps/heroslider/deren', // 支付回调域名URL
            'successurl' => U('gotocourse') // 成功跳转URL
        );
        session('orderData',$data);

        /* 跳转支付 */
        if(I('pay_type') == 1){
            $this->redirect("Pay/Index/index");
        } else {
            $this->redirect("Alipay/Index/index");
        }
    }
}
