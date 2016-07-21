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
                $this->display("Index/login"); die;  
            }
        }
	}
	/*默认显示页面*/
    public function index()
    {
		$this->display('Index/frame');
	}
	/*修改密码*/
	public function savepass()
	{
        $arr = session('user');
        $where = array(
            'password'=>I('password'),
            'id'=>$arr[0]['id']
        );
        $result = M(adminuser)->save($where);
        if($result){
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
	}
	/*退出登录*/
	public function tuichu()
	{
		session_start();
        session_unset();
        session_destroy();
        $this->redirect('Index/index',3000);
    }
}