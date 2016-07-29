<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller
{
	public function index(){
		$users_id = I('users_id');
		 /*分页*/
        $table = 'course';
        $condition = "";
        $tiao = 5;
        $type = I('type');
       /*调用分页函数返回*/
        $data = pageHandle($table,$condition,$tiao);
        /*按分类查询*/
        if ($type) {
            $where['type'] = $type;
        }
        $this->type=$type;
        /*查询记录*/
        $result = M('ordera')->where($where)->limit($data['limit'])->select();
        $this->assign('ordera',$result);
        $this->assign('page',$data['pages']['pages']);
		$this->display('index/bill_management');
	}
	/*删除订单*/
	public function deleteOrder(){
		if(!IS_AJAX){
			$this->error('页面不存在!');die;
		}
		$id = I('id');
        $where = array(
			'id'=>array('in',$id)
		);
        $result = M('ordera')->where($where)->delete();
        if($result){
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
		}
        $this->ajaxReturn($data,'json');
	}
	/*退款*/
	public function rebate(){
		if(!IS_AJAX){
			$this->error('页面不存在!');die;
		}
		$id = I('id');
		$where = array(
			'id'=>array('in',$id)
		);
		$arr = array(
			'status'=>2
		);
		$result = M('ordera')->where($where)->save($arr);
		if($result){
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
		}
        $this->ajaxReturn($data,'json');
	}
	 /* 导出订单表数据*/
    public function daochu2(){
        
        $id = ($_POST['id']);
        $condition = array(
            'id'=>array('in',$id)
        ); 
        $data = M('ordera')->where($condition)->select();
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