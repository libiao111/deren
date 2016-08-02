<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
    // check login
//    public function _initialize()
//    {
//        $user = session('user');
//        if(!isset($user['id']) && !isset($user['user'])) {
//            $this->redirect("Login/index");
//        }
//    }

    /*默认显示页面*/
    public function index()
    {
        $this->assign('user', session('user'));
        $this->display('Index/frame');
    }


    /*修改密码*/
    public function savepass()
    {
        $arr = session('user');
        $where = array(
            'password'=>md5(I('pass')),
            'id'=>$arr['id']
        );
       
        $result = M(adminuser)->save($where);
        if($result){
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
    }
    /*密码是否正确*/
    public function oldpass()
    {
        $arr = session('user');
        $where = array(
            'password'=>md5(I('oldpass')),
            'id'=>$arr['id']
        );
        $result = M(adminuser)->where($where)->find();
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
        $this->redirect('Index/login');
    }


}