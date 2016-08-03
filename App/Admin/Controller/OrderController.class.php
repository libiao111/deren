<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 订单
*/
class OrderController extends Controller
{
    // check
    // check post
    private function checkPost()
    {
        if (!IS_POST) {
            $this->error('页面不存在');
        }
    }
    // check ajax
    private function checkAjax()
    {
        if (!IS_AJAX) {
            $this->error('页面不存在');
        }
    }
    public function index()
    {
        
        $condition = array();
        $type = I('type');
        $this->type = $type ? $condition['type'] = $type:'';
        /*分页*/
        $page = pageHandle('bills', $condition, 10);
        $limit = $page['limit'];
        /*查询记录*/
        $info = D('bills')->relation('course')->where($condition)->limit($limit)->select();
        /* 显示页面 */
        $this->assign('ordera', $info);
        $this->assign('page', $page['pages']);
        $this->display('Index/bill_management');
    }

    /*删除订单*/
    public function deleteOrder(){
        $this->checkAjax();
        /*赋值数组*/
        $where = array('id'=>I('id'));
        /*执行删除操作*/
        $result = M('bills')->where($where)->delete();
        /*反馈*/
        $data = array('status'=> $result ? 1:0);
        $this->ajaxReturn($data,'json');
    }
    /*退款*/
    public function rebate(){
        $this->checkAjax();
        /*条件*/
        $where = array('id'=>array('in',I('id')));
        /*修改*/
        $arr = array('status'=>2);
        /*执行修改操作*/
        $result = M('bills')->where($where)->save($arr);
        /*反馈*/
        $data = array('status'=> $result ? 1:0);
        $this->ajaxReturn($data,'json');
    }
     /* 导出订单表数据*/
    public function daochu2(){
        $this->checkPost();
        /*获取id*/
        $id = ($_POST['id']);
        /*条件*/
        $condition = array('id'=>array('in',$id)); 
        /*执行操作*/
        $data = M('bills')->where($condition)->select();
        $title = array(
            array(
                'id' => 'id',
                'ordera_mobi'=>'手机号码',
                'ordera_name'=>'购买人姓名',
                'order_time'=>'购买时间',
                'status'=>'状态',
                'type'=>'课程类型',
                'current_price'=>'金额'
            )
        );
        $data = array_merge($title,$data);
        $name = date('Y-m-d H:i:s');
        $res = dataPush2($data,$name);
    }
}
?>