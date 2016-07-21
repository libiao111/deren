<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
	public function _initialize(){
		 if(!session('user')) {
            if (IS_AJAX) {
                $user = I('username');
                $pass = I('password');
                $arr = array(
                    'user'=>$user,
                    'password'=>$pass
                );
                $result = M('adminuser')->where($arr)->select();
                if($result){
                    $data = array('status'=>1);
                    session('user', $result);
                } else {
                    $data = array('status'=>0);
                }
                $this->ajaxReturn($data,'json');
            } else {
                $this->display("index/login"); die;  
            }
        }
	}
    public function index()
    {
		$this->display('Index/frame');
	}
	public function tuichu()
	{
		session_start();
        session_unset();
        session_destroy();
        $this->redirect('Index/login',3000);
    }
}