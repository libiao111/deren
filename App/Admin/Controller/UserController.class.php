<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 学员管理
*/
class UserController extends Controller
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
    public function index()
    {
        /*分页*/
        $condition = "";
        /*调用分页函数返回*/
        $data = pageHandle('users',$condition,15);
        /*查询记录*/
        $result = M('users')->limit($data['limit'])->select();

        $this->assign('page',$data['pages']['pages']);
        $this->assign('users',$result);
        $this->display('Index/member_man_reg');
    }
    /*用户删除*/
    public function deleteUser()
    {
        $this->checkAjax();
        /*赋值*/
        $where = array('id'=>I('id'));
        /*执行删除操作*/
        $result = M('users')->where($where)->delete();
        /*反馈*/
        $data = array('status'=>$result ? 1:0);
        $this->ajaxReturn($data,'json');
    }
    /*用户停用*/
    public function statusStop()
    {
        $this->checkAjax();
        $where = array('id'=>array('in',I('id')));
        $arr = array('status'=>0);
        /*执行操作*/
        $result = M('users')->where($where)->save($arr);
        /*反馈*/
        $data = array('status'=>$result ?1:0);
        $this->ajaxReturn($data,'json');
    }
    /*用户启用*/
    public function statusUsing()
    {
        $this->checkAjax();
        $where = array('id'=>array('in',I('id')));
        $arr = array('status'=>1);
        /*执行操作*/
        $result = M('users')->where($where)->save($arr);
        /*反馈*/
        $data = array('status'=>$result ?1:0);
        $this->ajaxReturn($data,'json');
    }
   
    /*回复初始密码*/
    public function rpassword()
    {
        $this->checkAjax();
        $where =array('id'=>array('in',I('id')));
        /*设置默认密码*/
        $arr = array('password' =>md5('123456'));
        /*执行操作*/
        $result = M('users')->where($where)->save($arr);
        /*反馈*/
        $data = array('status'=>$result ? 1:0);
        $this->ajaxReturn($data,'json');

    }
    /* 导出用户表数据*/
    public function daochu(){
        $this->checkPost();
        $id = $_POST['id'];
        $condition = array('id'=>array('in',$id)); 
        /*执行查询操作*/
        $data = M('users')->where($condition)->select();
        $title = array(
            array(
                'id' => '序号',
                'user_mobi'=>'电话',
                'username'=>'昵称',
                'sex'=>'性别',
                'logintime'=>'登录时间',
                'status'=>'状态'
            )
        );
        $data = array_merge($title,$data);
        $name = date('Y-m-d H:i:s'); 
        $res = dataPush($data,$name);
    }
}

?>