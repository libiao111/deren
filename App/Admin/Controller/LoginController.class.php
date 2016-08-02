<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 登录
*/
class LoginController extends Controller
{

    /* 显示页面 */
    public function index()
    {
        $this->display('Index/login');
    }

    /* 提交登录 */
    public function login()
    {
        if (!IS_AJAX) {
            $this->error('页面不存在');
        }
        $user = I('username');
        $pass = I('password');
        $arr = array(
            'user' => $user,
            'password' => md5($pass)
        );
        $result = M('adminuser')->where($arr)->field('password', true)->find();
        if($result){
            $data = array('status' => 1);
            session('user', $result);
        } else {
            $data = array('status' => 0);
        }
        $this->ajaxReturn($data, 'json');
    }


}