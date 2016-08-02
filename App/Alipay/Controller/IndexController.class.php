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
        $area = "http://www.gkdao.com/temps/heroslider";
        //收银台页面上，商品展示的超链接，必填
        switch ($data['type']) {
            case '1':
                $pagename = "offline";
                break;
            case '2':
                $pagename = "video";
                break;
            case '3':
                $pagename = "audio";
                break;
            default:
                 $pagename = "offline";
                break;
        }
        $id = $data['id'];
        $show_url = "$area/home/index/$pagename/id/$id";
        session('showurl',$showurl);
        //商品描述，可空
        switch ($data['type']) {
            case 1:
                $body =  '线下课';
                break;
            case 2:
                $body =  '视频课';
                break;
            case 3:
                $body =  '音频课';
                break;
            
            default:
                $body =  '线下课';
                break;
        };

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
        $alipayNotify = new \Alipay\Event\AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {
            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];
            //支付宝交易号
            $trade_no = $_GET['trade_no'];
            $showurl = session('showurl');
            //交易状态
            //$trade_status = $_GET['trade_status'];
            $where = array('ordera_num'=>$out_trade_no);
            $sql = M('bills')->where($where)->select();
            $arr = array(
                'id'    => $sql['id'],
                'trade' => $trade_no
            );
            $result = M('bills')->save($arr);
            $this->showurl=$showurl;
            $this->display('Index/gotocourse');

        }
        else {
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
            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            //$trade_status = $_POST['trade_status'];
            $showurl = session('showurl');
            //交易状态
            //$trade_status = $_GET['trade_status'];
            $where = array('ordera_num'=>$out_trade_no);
            $sql = M('bills')->where($where)->select();
            $arr = array(
                'id'    => $sql['id'],
                'trade' => $trade_no
            );
            $result = M('bills')->save($arr);
            $this->showurl=$showurl;
            $this->display('Index/gotocourse');
        } else {
            
            echo "fail";

        }
    }








}