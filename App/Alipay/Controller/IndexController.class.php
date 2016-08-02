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
        $data = session('orderData');
        /**************************请求参数**************************/
        
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $data['bills'];

        //订单名称，必填
        $subject = $data['title'];

        //付款金额，必填
        // $total_fee = $data['price'];
        $total_fee = 0.01;

        //收银台页面上，商品展示的超链接，必填
        $show_url = $data['course_url'];

        //商品描述，可空
        $body = $data['type']

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
        );

        //建立请求
        header('Content-Type:text/html; charset=utf-8');
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
        $alipayNotify = new \Alipay\Event\AlipayNotifyEvent($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if ($verify_result) {

            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号
            $trade_no = $_GET['trade_no'];

            //交易状态
            //$trade_status = $_GET['trade_status'];

            /* 更新订单状态 */
            $where = array('order_num' => $out_trade_no);
            $id = M('bills')->where($where)->getField('id');
            if ($id) {
                $data = array(
                    'id' => $id,
                    'status' => 1,
                    'trade'  => $trade_no
                );
                M('bills')->save($data);
            }

            /* 显示页面 */
            $showurl = session('showurl');
            $this->assign('showurl', $showurl);
            $this->display('Home@Index/gotocourse');
        } else {
            header('Content-Type:text/html; charset=utf-8');
            echo "验证失败";
        }
    }


    /* 异步通知 */
    public function notify_url()
    {
        $alipay_config = getConfig();
        $alipayNotify = new \Alipay\Event\AlipayNotifyEvent($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        // 验证成功
        if ($verify_result) {
            // 商户订单号
            $out_trade_no = $_POST['out_trade_no'];

            // 支付宝交易号
            $trade_no = $_POST['trade_no'];

            // 交易状态
            $trade_status = $_POST['trade_status'];

            /* 更新订单状态 */
            $where = array('order_num' => $out_trade_no);
            $id = M('bills')->where($where)->getField('id');
            if ($id) {
                $data = array(
                    'id' => $id,
                    'status' => 1,
                    'trade'  => $trade_no
                );
                M('bills')->save($data);
            }

            // 请不要修改或删除
            echo "success";     
        } else {
            // 验证失败
            echo "fail";
        }
    }








}