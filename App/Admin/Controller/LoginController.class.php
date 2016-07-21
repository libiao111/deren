<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class LoginController extends Controller
{
<<<<<<< HEAD
    
    public function index()
    {
    	if(IS_AJAX){
            $user = I('username');
            $pass = I('password');
            $arr = array(
				'user' =>$user,
				'password'	=>$pass
			);
			$result = M('adminuser')->where($arr)->field('password', true)->find();
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
    public function tuichu(){
		session_start();
        session_unset();
        session_destroy();
        $this->redirect('Index/login',3000);
    }
=======
	
	
>>>>>>> 1a6eca5c69658d30629e1fa572add913ec2499e4
}