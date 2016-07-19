<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class LoginController extends Controller
{
    
    public function index()
    {
    	if(IS_AJAX){
			$user = I('user_mobi');
            $pass = I('password');
			$arr = array(
				'user_mobi' =>$user,
				'password'	=>md5($pass),
			);
			$result = M('users')->where($arr)->field('password', true)->find();
			if($result){
				$data = array('status' =>1);
				session('user',$result);
			}else{
				$data = array('status'=>0);
			}
			$this->ajaxReturn($data,'json');
		} else {
			$this->error('页面不存在!');die;
		}
}