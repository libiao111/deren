<?php 


/*微信支付测试*/
function test() {
    ini_set('date.timezone','Asia/Shanghai');
    error_reporting(E_ERROR);

    require_once("./Public/plugin/wxp/lib/WxPay.Api.php");
    require_once("./Public/plugin/wxp/example/WxPay.JsApiPay.php");
    require_once('./Public/plugin/wxp/example/log.php');

    /*初始化日志*/
    $logHandler= new CLogFileHandler("./Public/plugin/wxp/logs/".date('Y-m-d').'.log');
    $log = Log::Init($logHandler, 15);

    /*获取用户openid*/
    $tools = new JsApiPay();
    $openId = $tools->GetOpenid();

    /*回调路径*/
    $notify_url = "http://www.sunraine.com/admin.php/upload/loadimg/notify.ogv";
    $bills = WxPayConfig::MCHID.date("YmdHis");

    /*统一下单*/
    $input = new WxPayUnifiedOrder();
    $input->SetBody("PHOCUS虚拟商品");                      /*商品名称*/
    $input->SetAttach("test");                              /*数据包，原样返回*/
    $input->SetOut_trade_no($bills);                        /*订单号*/
    $input->SetTotal_fee("1");                              /*金额*/
    $input->SetTime_start(date("YmdHis"));                  /*支付开始时间*/
    $input->SetTime_expire(date("YmdHis", time() + 600));   /*支付过期时间*/
    $input->SetGoods_tag("test");                           /*商品签名*/
    $input->SetNotify_url($notify_url);                     /*回调路径*/    
    $input->SetTrade_type("JSAPI");                         /*支付方式*/
    $input->SetOpenid($openId);                             /*openid*/

    $order = WxPayApi::unifiedOrder($input); p($order);
    $jsApiParameters = $tools->GetJsApiParameters($order);
    return $jsApiParameters;
}

function notify() {
    ini_set('date.timezone','Asia/Shanghai');
    error_reporting(E_ERROR);

    require_once "./Public/plugin/wxp/lib/WxPay.Api.php";
    require_once './Public/plugin/wxp/lib/WxPay.Notify.php';
    require_once './Public/plugin/wxp/example/log.php';

    /*初始化日志*/
    $logHandler= new CLogFileHandler("./Public/plugin/wxp/logs/".date('Y-m-d').'.log');
    $log = Log::Init($logHandler, 15);

    class PayNotifyCallBack extends WxPayNotify
    {
        /*查询订单*/
        public function Queryorder($transaction_id)
        {
            $input = new WxPayOrderQuery();
            $input->SetTransaction_id($transaction_id);
            $result = WxPayApi::orderQuery($input);
            Log::DEBUG("query:" . json_encode($result));
            if(array_key_exists("return_code", $result)
                && array_key_exists("result_code", $result)
                && $result["return_code"] == "SUCCESS"
                && $result["result_code"] == "SUCCESS")
            {
                M('needs')->add(array(
                    'name' => '订单号 '.$result["out_trade_no"],
                    'needs' => '支付号 '.$result["transaction_id"]
                ));
                return true;
            }
            return false;
        }
        
        /*重写回调处理函数*/
        public function NotifyProcess($data, &$msg)
        {
            Log::DEBUG("call back:" . json_encode($data));
            $notfiyOutput = array();
            
            if(!array_key_exists("transaction_id", $data)){
                $msg = "输入参数不正确";
                return false;
            }
            /*查询订单，判断订单真实性*/
            if(!$this->Queryorder($data["transaction_id"])){
                $msg = "订单查询失败";
                return false;
            }
            return true;
        }
    }

    Log::DEBUG("begin notify");
    $notify = new PayNotifyCallBack();
    $notify->Handle(false);
    
}





?>