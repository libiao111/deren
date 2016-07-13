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
        ini_set('date.timezone','Asia/Shanghai');
        error_reporting(E_ERROR);

        /*配置信息及订单处理*/
        $url = './Public/wxp';
        require_once("$url/lib/WxPay.Api.php");
        require_once("$url/example/WxPay.JsApiPay.php");
        require_once("$url/example/log.php");
        /*生成订单数据*/
        $sign       = I('sign') ? I('sign') : $this->error('缺少商品签名');
        $title      = I('title') ? I('title') : $this->error('缺少商品名称');
        $bills      = I('bills') ? I('bills') : $this->error('缺少商品订单号');
        $price      = I('price') ? (I('price') * 100) : $this->error('缺少商品价格');
        $realm      = I('realm') ? I('realm') : $this->error('缺少通告回调域名(/index.php 之前的路径)');
        $successurl = I('successurl') ? I('successurl') : $this->error('缺少支付成功跳转路径');
        $data       = I('data') ? I('data') : '';

        /*初始化日志*/
        /*$logHandler= new CLogFileHandler("$url/logs/".date('Y-m-d').'.log');
        $log = Log::Init($logHandler, 15);*/
        logHand();
        /*获取用户openid*/
        /*$tools = new JsApiPay();
        $openId = $tools->GetOpenid();*/

        /*通告回调路径*/
        $notify_url = "$realm/index.php/pay/index/notifyHandle.ogv";
        if (!$bills) {
            $bills = WxPayConfig::MCHID.date("YmdHis");
        }

        /*统一下单*/
        $input = new WxPayUnifiedOrder();
        $input->SetBody($title);                                /*商品名称*/
        $input->SetAttach($data);                               /*数据包，原样返回*/
        $input->SetOut_trade_no($bills);                        /*订单号*/
        $input->SetTotal_fee($price);                           /*金额*/
        $input->SetTime_start(date("YmdHis"));                  /*支付开始时间*/
        $input->SetTime_expire(date("YmdHis", time() + 600));   /*支付过期时间*/
        $input->SetGoods_tag($sign);                            /*商品签名*/
        $input->SetNotify_url($notify_url);                     /*回调路径*/    
        $input->SetTrade_type("JSAPI");                         /*支付方式*/
        $input->SetOpenid($openId);                             /*openid*/

        /* 下单信息 */
        $order = WxPayApi::unifiedOrder($input);
        $this->assign('jsApiParameters', $tools->GetJsApiParameters($order));

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