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
        
        /*生成订单数据*/
        $arr = session('arr');
        $arr['sign'] ? $arr['sign'] : $this->error('缺少商品签名');
        $arr['title'] ? $arr['title'] : $this->error('缺少商品名称');
        $arr['bills'] ? $arr['bills'] : $this->error('缺少商品订单号');
        $arr['price'] ? ($arr['price'] * 100) : $this->error('缺少商品价格');
        $arr['realm'] ? $arr['realm'] : $this->error('缺少通告回调域名(/index.php 之前的路径)');
        $arr['successurl'] ? $arr['successurl'] : $this->error('缺少支付成功跳转路径');
        $arr['data'] ? $arr['data'] : 'data';

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
    public function aa(){
        getid();
    }
}