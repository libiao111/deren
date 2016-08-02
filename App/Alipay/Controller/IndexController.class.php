<?php
namespace Alipay\Controller;
use Think\Controller;
/**
* 支付宝
*/
class IndexController extends Controller
{
    
    public function index()
    {
        header('Content-Type:text/html; charset=utf-8');
        /**************************请求参数**************************/
        
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $_POST['WIDout_trade_no'];

        //订单名称，必填
        $subject = $_POST['WIDsubject'];

        //付款金额，必填
        $total_fee = $_POST['WIDtotal_fee'];

        //收银台页面上，商品展示的超链接，必填
        $show_url = $_POST['WIDshow_url'];

        //商品描述，可空
        $body = $_POST['WIDbody'];

        /************************************************************/

        //构造要请求的参数数组，无需改动
        $alipay_config = getConfig();
        $parameter = array(
            "service"       => $alipay_config['service'],
            "partner"       => $alipay_config['partner'],
            "seller_id"     => $alipay_config['seller_id'],
            "payment_type"  => $alipay_config['payment_type'],
            "notify_url"    => $alipay_config['notify_url'],
            "return_url"    => $alipay_config['return_url'],
            "_input_charset" => trim(strtolower($alipay_config['input_charset'])),
            "out_trade_no"  => $out_trade_no,
            "subject"       => $subject,
            "total_fee"     => $total_fee,
            "show_url"      => $show_url,
            "body"          => $body,
            //其他业务参数根据在线开发文档，添加参数.
            //文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.2Z6TSk&treeId=60&articleId=103693&docType=1
            //如"参数名"    => "参数值"   注：上一个参数末尾需要“,”逗号。
        );

        //建立请求

        // $alipaySubmit = new AlipaySubmit($alipay_config);
        // $alipaySubmit = A('AlipaySubmit', 'Event');
        $alipaySubmit = new \Alipay\Event\AlipaySubmitEvent($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
    }


    /* 同步通知 */
    public function return_url()
    {
        $alipay_config = getConfig();
        //计算得出通知验证结果
        // $alipayNotify = new AlipayNotify($alipay_config);
        $alipayNotify = new \Alipay\Event\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号

            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号

            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];


            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
            }
            else {
              echo "trade_status=".$_GET['trade_status'];
            }

            echo "验证成功<br />";

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";
        }
    }


    /* 异步通知 */
    public function notify_url()
    {
        $alipay_config = getConfig();
        //计算得出通知验证结果
        // $alipayNotify = new AlipayNotify($alipay_config);
        $alipayNotify = new \Alipay\Event\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            
            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                
            echo "success";     //请不要修改或删除
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }








}