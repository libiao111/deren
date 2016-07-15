<?php
namespace Pay\Controller;
use Think\Controller;
/**
* 支付管理
*/
class IndexController extends Controller
{
    
    /* 生成支付信息 */
    public function index()
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
        /* 写入订单 */
        $result = M('ordera')->add($arr);

        $arr = array(
            'sign'      => '[德仁商学院]',
            'title'     => $sql['course_name'],
            'bills'     => $ordera_num,
            'price'     => $sql['current_price'],
            'realm'      => 'http://www.gkdao.com/temps/heroslider/deren',
            'successurl' => U('home/index/gotocourse'),
            'data'      => 'data'
        );

        /*生成订单数据*/
        /*$arr = session('arr');
        $arr['sign'] ? $arr['sign'] : $this->error('缺少商品签名');
        $arr['title'] ? $arr['title'] : $this->error('缺少商品名称');
        $arr['bills'] ? $arr['bills'] : $this->error('缺少商品订单号');
        $arr['price'] ? ($arr['price'] * 100) : $this->error('缺少商品价格');
        $arr['realm'] ? $arr['realm'] : $this->error('缺少通告回调域名(/index.php 之前的路径)');
        $arr['successurl'] ? $arr['successurl'] : $this->error('缺少支付成功跳转路径');
        $arr['data'] ? $arr['data'] : 'data';*/

        // p($_GET);

        /* 下单 */
        $result = logHand($arr);
        $this->assign('jsApiParameters', $result);

        /* 支付成功跳转路径 */
        $this->assign('successurl', $arr['successurl']);

        /* 显示页面 */
        $this->display();
    }


    /*微信支付成功通告*/
    public function notifyHandle()
    {
        notify();
    }

}