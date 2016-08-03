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
        // $openid = session('openid');
        // if (count($openid) == 0) {
        //     $openid = getOpenID();
        //     if ($openid['status'] == 0) {
        //         $this->redirect('Open/index');
        //     }
        // }

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
        $course = M("course")->where(array('status' => 1))->order('id')->select();
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
        $where['status'] = 1;
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
        $where['status'] = 1;
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
        $where['status'] = 1;
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
        $arr2 = array(
            'course_id' => $id,
            'users_id'=>$users_id
        );
        
        /*关联查询课程表*/
        $result = M("course")->where(array('id' => $id))->find();
        $result['class'] = D("class")->relation('img')->where(array('course_id' => $id))->select();
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
        $arr = array('id'=>$id);
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
        /* check login */
        $user_id = session('user')['id'];
        if (!$user_id) {
            $this->login();
            die;
        }

        $id = I('course_id');

        /* 课程信息 */
        $filed = 'course_name,current_price,type';
        $course = M('course')->where(array('id' => $id))->field($filed)->find();
        
        /*生成订单号*/
        $ordera_num = 'DRKC'.time().rand('1000','9999');
        
        /* 订单信息 */
        $order = array(
            'users_id'      => $user_id,
            'course_id'     => I('course_id'),
            'order_num'     => $ordera_num,
            'user_name'     => I('user_name'),
            'user_phone'    => I('user_phone'),
            'course_price'  => $course['current_price'],
            'pay_type'      => I('pay_type'),
            'type'          => $course['type'],
            'status'        => 0,
            'order_time'    => date('Y-m-d H:i:s')
        );
        $result = M('bills')->add($order);

        /* 课程详情页面名称 */
        switch ($course['type']) {
            case '1':
                $pagename = "offline";
                $type = '线下课';
                break;
            case '2':
                $pagename = "video";
                $type = '视频课';
                break;
            case '3':
                $pagename = "audio";
                $type = '音频课';
                break;
            default:
                $pagename = "offline";
                $type = '线下课';
                break;
        }

        /* 支付信息 */
        $data = array(
            'sign'  => '[德仁商学院]',              // 签名
            'bills' => $ordera_num,                 // 订单号
            'title' => $course['course_name'],      // 商品名
            'price' => $course['current_price'],    // 支付价格
            'type'  => $type,                       // 课程类型
            'course_url' => C('PAY_AREA').U($pagename, array('id' => $order['course_id'])) // 支付成功回调-课程路径
        );

        // 支付成功回调-课程路径
        session('showurl', $data['course_url']);

        // 支付信息
        session('orderData', $data);

        /* 跳转支付 */
        if (I('pay_type') == 1) {
            $info = array(
                'user_name' => $order['user_name'],
                'user_phone' => $order['user_phone'],
                'course_name' => $course['course_name'],
                'course_price' => $course['current_price']
            );
            session('pay_info', $info);
            $this->redirect("Pay/Index/index");
        } else {
            $this->redirect("Alipay/Index/index");
        }
    }
}
