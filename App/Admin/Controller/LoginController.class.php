<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 登录
*/
class LoginController extends Controller
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
    /* 显示页面 */
    public function index()
    {
        $this->display('Index/login');
    }

    /* 提交登录 */
    public function login()
    {
        $this->checkAjax();
        $user = I('username');
        $pass = I('password');
        $arr = array(
            'user' => $user,
            'password' => md5($pass)
        );
        $result = M('adminuser')->where($arr)->field('password', true)->find();
        if($result){
            session('user', $result);
        }
        $data = array('status' => $result ? 1:0);
        $this->ajaxReturn($data, 'json');
    }


}