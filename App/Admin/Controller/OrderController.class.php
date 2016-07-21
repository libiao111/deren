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
       /*调用分页函数返回*/
        $data = pageHandle($table,$condition,$tiao);
        /*按分类查询*/
        $where = array(
        	'type'=>1
    	);
		/*查询记录*/
        $result = M('ordera')->where($where)->limit($data['limit'])->select();
        $this->assign('page',$data['pages']['pages']);
		$this->display('bill_management');
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
	}
	/*退款*/
	public function rebate(){
		/*if(!IS_AJAX){
			$this->error('页面不存在!');die;
		}*/
		$id = I('id');
		$status = I('status');
		$where = array(
			'id'=>array('in',$id)
		);
		$arr = array(
			'status'=>$status
		);
		$result = M('ordera')->where($where)->save($arr);
		if($result){
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
		}
	}
}
?>