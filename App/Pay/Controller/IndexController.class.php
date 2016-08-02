<?php
namespace Pay\Controller;
use Think\Controller;
/**
* 支付管理
*/
class IndexController extends Controller
{
    // pay
    /* 生成支付信息 */
    public function index()
    {
        /*生成订单数据*/
        $arr = session('orderData');
        $arr['sign'] ? '' : $this->error('缺少商品签名');
        $arr['title'] ? '' : $this->error('缺少商品名称');
        $arr['bills'] ? '' : $this->error('缺少商品订单号');
        $arr['price'] ? '' : $this->error('缺少商品价格');

        /* 下单 */
        $result = logHand($arr);
        $this->assign('jsApiParameters', $result);

        /* 支付成功跳转路径 */
        $this->assign('successurl', $arr['course_url']);

        /* 显示页面 */
        $this->display();
    }


    /*微信支付成功通告*/
    public function notifyHandle()
    {
        notify();
    }
    
}