<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller
{
	public function index(){

		$result = M('user')->select();
		$where="";
        /*分页*/
        $table = 'course';
        $condition = "";
        $tiao = 2;
        /*调用分页函数返回*/
        $data = pageHandle($table,$condition,$tiao);
        /*查询记录*/
        $result = M('user')->limit($data['limit'])->select();
        $this->assign('page',$data['pages']['pages']);
        $this->assign('user',$result);
        $this->display('index/member_man_reg');
	}
	public function deleteUser()
	{
		if (!IS_AJAX) {
			$this->error('页面不存在!');
		}
		$id = I('id');
		$where = array(
			'id'=>array('in',$id)
		);
		$result = M('user')->where($where)->delete();
		if ($result) {
			$data =array('status'=>1);
		} else {
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
	}
	public function statusUser()
	{
		if (!IS_AJAX) {
			$this->error('页面不存在!');
		}
		$id = I('id');
		$status = I('status');
		$where = array(
			'id'=>array('in',$id),
		);
		$arr = array(
			'status'=>$status
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