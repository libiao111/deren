<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller
{
	public function index()
	{
		$where="";
        /*分页*/
        $table = 'users';
        $condition = "";
        $tiao = 2;
        /*调用分页函数返回*/
        $data = pageHandle($table,$condition,$tiao);
        /*查询记录*/
        $result = M('users')->limit($data['limit'])->select();
        $this->assign('page',$data['pages']['pages']);
        $this->assign('users',$result);
        $this->display('index/member_man_reg');
	}
	/*用户删除*/
	public function deleteUser()
	{
		if (!IS_AJAX) {
			$this->error('页面不存在!');
		}
		$id = I('id');
		$where = array(
			'id'=>array('in',$id)
		);
		$result = M('users')->where($where)->delete();
		if ($result) {
			$data =array('status'=>1);
		} else {
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
	}
	/*用户停用*/
	public function statusStop()
	{
		if (!IS_AJAX) {
			$this->error('页面不存在!');
		}
		$id = I('id');
		$where = array(
			'id'=>array('in',$id),
		);
		$arr = array(
			'status'=>1
		);
		$result = M('users')->where($where)->save($arr);
        if ($result) {
			$data =array('status'=>1);
		} else {
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
	}
	/*用户启用*/
	public function statusUsing()
	{
		if (!IS_AJAX) {
			$this->error('页面不存在!');
		}
		$id = I('id');
		$where = array(
			'id'=>array('in',$id),
		);
		$arr = array(
			'status'=>0
		);
		$result = M('users')->where($where)->save($arr);
		if ($result) {
			$data =array('status'=>1);
		} else {
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
	}
   
	/*回复初始密码*/
	public function rpassword(){
		if(!IS_AJAX){
			$this->error('页面不存在!');
		}
		$id = I('id');
		$where =array(
			'id'=>array('in',$id)
		);
		$arr = array(
			'password' =>'1234'
		);
		$result = M('users')->where($where)->save($arr);
		if ($result) {
			$data =array('status'=>1);
		} else {
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');

	}
}

?>