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
        
        $arr = session('arr');
        /*$arr = array(
            'sign'=>I('sign'),
            'title'=>I('title'),
            'bills'=>I('bills'),
            'price'=>I('price'),
            'realm'=>I('realm'),
            'successurl'=>I('successurl')
        );*/

        /*生成订单数据*/
        $sign       = $arr['sign'] ? $arr['sign'] : $this->error('缺少商品签名');
        $title      = $arr['title'] ? $arr['title'] : $this->error('缺少商品名称');
        $bills      = $arr['bills'] ? $arr['bills'] : $this->error('缺少商品订单号');
        $price      = $arr['price'] ? ($arr['price'] * 100) : $this->error('缺少商品价格');
        $realm      = $arr['realm'] ? $arr['realm'] : $this->error('缺少通告回调域名(/index.php 之前的路径)');
        $successurl = $arr['successurl'] ? $arr['successurl'] : $this->error('缺少支付成功跳转路径');
        $data       = I('data') ? I('data') : '';
        $this->assign('jsApiParameters',logHand());
        /* 支付成功跳转路径 */
        $this->assign('successurl', $successurl);

        /* 显示页面 */
        $this->display();
        p($tools->GetJsApiParameters($order));

    }


    /*微信支付成功通告*/
    public function notifyHandle()
    {
        notify();
    }

}