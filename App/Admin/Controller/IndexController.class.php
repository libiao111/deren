<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
    public function _initialize(){
        // if(!session('user')) {
        //     if (IS_AJAX) {
        //         $user = I('username');
        //         $pass = I('password');
        //         $arr = array(
        //             'user'=>$user,
        //             'password'=>$pass
        //         );
        //         $result = M('adminuser')->where($arr)->select();
        //         if($result){
        //             $data = array('status'=>1);
        //             session('user', $result);
        //         } else {
        //             $data = array('status'=>0);
        //         }
        //         $this->ajaxReturn($data,'json');
        //     } else {
        //         $this->display("Index/login"); die;  
        //     }
        // }
    }
    
    /*默认显示页面*/
    public function index()
    {
        $arr = session('user');
        $this->user=$arr[0]['user'];
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








       /* 导入销售机会 */
    public function daoru() {
        if (!IS_POST) {
            $this->error('页面不存在');
            die;
        }
        if (!empty($_FILES['fileexcel']['name'])) {
            $content = $_FILES['fileexcel']['tmp_name'];
            $type = explode (".", $_FILES['fileexcel']['name']);
            $type = strtolower($type[1]);
            /* 限制文件格式 */
            if ($type != "xlsx" && $type != "xls") {
                $this->error ('仅支持：slsx/sls');
            }
            /* 导入文件 */
            $arr = read($content, $type);
            $join = dataHandle($arr);
            $this->display('index');
            $result = M('users')->addAll($join);
            if ($result) {
                $this->redirect('index');
            } else {
                $this->error ('导入数据失败');
            }
        } else {
            $this->error ('数据错误');
        }
    }


    
   

}