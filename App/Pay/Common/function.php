<?php
function notify(){
	ini_set('date.timezone','Asia/Shanghai');
        error_reporting(E_ERROR);

        $url = './Public/wxp';
        require_once "$url/lib/WxPay.Api.php";
        require_once "$url/lib/WxPay.Notify.php";
        require_once "$url/example/log.php";

        /*初始化日志*/
        $logHandler= new CLogFileHandler("$url/logs/".date('Y-m-d').'.log');
        $log = Log::Init($logHandler, 15);

        class PayNotifyCallBack extends WxPayNotify{
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
                    /*修改支付状态 $result["out_trade_no"]订单号*/
                    $cd = array(
                        'bills' => $result["out_trade_no"]
                    );
                    M('client_yuyue')->where($cd)->save(array('pay' => 1));
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
function logHand(){
    $logHandler= new CLogFileHandler("$url/logs/".date('Y-m-d').'.log');
    $log = Log::Init($logHandler, 15);
    $tools = new JsApiPay();
    $openId = $tools->GetOpenid();
}