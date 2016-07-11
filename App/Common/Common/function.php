<?php
/* ---------------------------------------Common公用函数--------------------------------------- */
/* ---------------------------------------Common公用函数--------------------------------------- */
/* ---------------------------------------Common公用函数--------------------------------------- */

/*打印方法*/
function p($array) {
	dump($array, 1, '', 0);
}

//rbac节点递归重组 
function node_merge($node, $pid = 0){
    $arr = array();
    foreach($node as $v){
        if($v['pid'] == $pid){
            $v['child'] = node_merge($node, $v['id']);
            $arr[]=$v;
        }
    }
    return $arr;
}

/*裁剪字符*/
function substr_cut($str, $start, $len = '', $type = 0)
{
    $k = array('',' ','\t','\r','\n');
    $wk = array('','','','','');
    $str = str_replace($k,$wk,$str);
    if (strlen($str) > $start) {
        $tmpstr = "";
        if ($len == '') {$len = $start; $start = 0; }
        for ($i = 0; $i < $len; $i++)
        {
            if ($start <= $i) {
                if ( ord( substr($str, $i, 1) ) > 0xa0 ) {
                    $tmpstr .= substr($str, $i, 3);
                    $i += 2;
                } else {
                    $tmpstr .= substr($str, $i, 1);
                }
            } else {
                if ( ord( substr($str, $i, 1) ) > 0xa0 ) {$i += 2; }
            }
        }
        if ($type) {
            return $tmpstr;
        } else {
            return $tmpstr.'...';
        }
    } else {
        return $str;
    }
}

/*
* 页码类调用
* $table     表单
* $condition 查询条件
* $tiao 	 默认15条
*/
function pageHandle($table, $condition = null, $tiao = null)
{
    /*分页*/
    if (!$tiao) {
        $tiao = 15;
    }
    $count =  M($table)->where($condition)->count();
    $pages = new \Think\Page($count,$tiao);
    $pages->lastSuffix = false;
    $pages->rollPage = 5;
    $pages->setConfig('prev','<');
    $pages->setConfig('first','<<');
    $pages->setConfig('next','>');
    $pages->setConfig('last','>>');
    $limit = $pages->firstRow.','.$pages->listRows;
    $data = array(
        'limit' => $limit,
        'pages' => array(
            'count' => $count,
            'showt' => $tiao,
            'pages' => $pages->show()
        )
    );
    return $data;
}



/*缩略切图*/
function photo_cut($img, $width, $height = null)
{
    if (!$height) {
        $height = $width;
    }
    $imgurl = '../think/resource/'.$img;
    $imgs = new \Think\Image();
    // 获取需要处理的图片
    $imgs->open($imgurl);
    // 生成缩略图 宽,高,类型6种：3剧中
    $imgs->thumb($width,$height,3);
    // 保存路径+名称
    $imgs->save($imgurl,'png');
    return $img;
}


/* 上传图片 */
function uploadHandle($file, $width, $height = null)
{
    // $_FILES
    if (!$height) {
        $height = $width;
    }
    $upload = new \Think\Upload();
    $upload->mimes      = array('image/jpeg','image/png');
    $upload->exts       = array('jpg','png');
    $upload->maxSize    = '2097152';
    $upload->hash       = false;
    $upload->rootPath   = '../think/resource/';
    $upload->saveExt    = 'png';
    $upload->saveName   = array('date', 'YmdHis-'.rand(1000,9999));
    $status = $upload->upload($file);
    if ($status) {
        $result = $status['file']['savepath'].$status['file']['savename'];
        if ($width) {
            $result = photo_cut($result, $width, $height);
        }
    } else {
        $result = $upload->getError();
    }
    return $result;

}


/* --------------------------------------------------------------------------------------- */
/* ---------------------------------------微信支付---------------------------------------- */
/* --------------------------------------------------------------------------------------- */

    /* 提交生成订单 */
    /*public function newBills() {
        #code ...
        $this->redirect('home/index/bill');
    }*/

    /* 微信支付页面 */
    /*public function bill() {
        $this->jsApiParameters = submit_pay($note['bills'], $note['xiwei']);
        $this->display();
    }*/


    /* 微信支付页面调用JS */
    /*$(window).ready(function () {
        var codeUrl = "__CHAJIAN__/code/succeed.php";
        var successUrl =  "{:U('success')}";
        function jsApiCall() {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                {$jsApiParameters},
                function(res){
                    if (res.err_msg == "get_brand_wcpay_request:ok") {
                        var arr = {
                            phone: '{$showinfo.phone}',
                            fuwu: '{$showinfo.time} {$showinfo.fuwu}'
                        };
                        $.post(codeUrl, arr, function (data) {
                            window.location.href = successUrl;
                        });
                    }
                }
            );
        }
        $('#callpay').click(function () {
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        });
    });*/


    /* 支付成功通告 */
    /*public function notify() {
        notify();
    }*/


    /* 支付成功页面 */
    /*public function success() {
        $this->display();
    }*/



/*微信支付*/
function submit_pay($bills = null, $xiwei) {

    ini_set('date.timezone','Asia/Shanghai');
    error_reporting(E_ERROR);

    require_once("./Public/Plugin/wxp/lib/WxPay.Api.php");
    require_once("./Public/Plugin/wxp/example/WxPay.JsApiPay.php");
    require_once('./Public/Plugin/wxp/example/log.php');

    /*初始化日志*/
    $logHandler= new CLogFileHandler("./Public/Plugin/wxp/logs/".date('Y-m-d').'.log');
    $log = Log::Init($logHandler, 15);

    /*获取用户openid*/
    $tools = new JsApiPay();
    $openId = $tools->GetOpenid();

    /*通告回调路径*/
    $notify_url = "http://wozaiyuntian.com/index.php/home/index/notify.ogv";
    if (!$bills) {
        $bills = WxPayConfig::MCHID.date("YmdHis");
    }

    /*统一下单*/
    $input = new WxPayUnifiedOrder();
    $input->SetBody("【云相馆】摄影服务");                  /*商品名称*/
    $input->SetAttach("test");                              /*数据包，原样返回*/
    $input->SetOut_trade_no($bills);                        /*订单号*/
    $input->SetTotal_fee(3000*$xiwei);                      /*金额*/
    $input->SetTime_start(date("YmdHis"));                  /*支付开始时间*/
    $input->SetTime_expire(date("YmdHis", time() + 600));   /*支付过期时间*/
    $input->SetGoods_tag("我在云天");                       /*商品签名*/
    $input->SetNotify_url($notify_url);                     /*回调路径*/    
    $input->SetTrade_type("JSAPI");                         /*支付方式*/
    $input->SetOpenid($openId);                             /*openid*/

    $order = WxPayApi::unifiedOrder($input);
    return $tools->GetJsApiParameters($order);
}

/*微信支付成功通告*/
function notify() {
    ini_set('date.timezone','Asia/Shanghai');
    error_reporting(E_ERROR);

    require_once "./Public/Plugin/wxp/lib/WxPay.Api.php";
    require_once './Public/Plugin/wxp/lib/WxPay.Notify.php';
    require_once './Public/Plugin/wxp/example/log.php';

    /*初始化日志*/
    $logHandler= new CLogFileHandler("./Public/Plugin/wxp/logs/".date('Y-m-d').'.log');
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
                $cd = array('bills' => $result["out_trade_no"]);
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
