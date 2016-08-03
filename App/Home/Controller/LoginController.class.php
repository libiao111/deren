<?php
namespace Home\Controller;
use Think\Controller;
/**
* 登录
*/
class LoginController extends Controller 
{
    /*
    用户登录
    */
    public function loginhandle()
    {
        if (IS_AJAX) {
            /* 获取信息 */
            $user = I('user_mobi');
            $pass = md5(I('password'));
            $arr = array( 'user_mobi' => $user);

            /* 查询账户 */
            $result = M('users')->where($arr)->find();
            if (!$result) {
                $this->ajaxReturn(array('status' => 0),'json');
            }

            /* 密码不正确 */
            if ($pass != $result['password']) {
                $this->ajaxReturn(array('status' => 3),'json');
            }

            /* 账户被停用 */
            if ($result['status'] != 1){
                $this->ajaxReturn(array('status' => 2),'json');
            }

            /* 登录成功 */
            session('user',$result);
            $this->ajaxReturn(array('status' => 1),'json');
        } else {
            $this->error('页面不存在!');die;
        }
    }

    /*
    验证手机号是否存在
    */
    public function register1()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
        $arr = array('user_mobi'=>I('user_mobi'));
        $result = M('users')->where($arr)->find();
        if($result){
            $data = array('status' => 1);
        }else{
            $data = array('status' => 0);
        }
        $this->ajaxReturn($data,'json');
    }

    /*
    获取验证码
    */
    public function sms()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
        
        /*赋值变量*/
        $phone = I('user_mobi');
        /*生成六位随机数*/
        $str = rand('100000','999999');
        $data['code'] = $str;
        $data['user_mobi'] = $phone;
        $code = pullCode($data);
        /*返回状态*/
        if($code){
            $data = array(
                'status' => 1,
                'code' => $code
            );
            session('str',md5($str));
        }else{
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
    }

    /*
    用户注册
    */
    public function register()
    {
        if (!IS_AJAX) {
            $this->error('页面不存在!');die;
        }
        $user = session('openid');
        /*session 获取验证码*/
        $str = session('str');
        /*赋值变量*/
        $code = md5(I('code'));
        /*判断验证码是否正确*/
        if($code !=$str){
            $data = array('status' => 2);
            $this -> ajaxReturn($data,'json');
        }
        $password = I('password');
        $arr = array(
            'password'      => md5($password),
            'user_mobi'     => I('user_mobi'),
            'username'      => $user['name'],
            'sex'           => $user['sex'],
            'user_photo'    => $user['image']
        );
        $result = M('users')->add($arr);
        /*返回状态*/
        if ($result) {
            $data = array('status'=>1);
            $arr['id'] = $result;
            unset($arr['password']);
            session('user', $arr);
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
    }

    /*修改密码*/
    public function xiugai()
    {
        if(!IS_AJAX){
            $this->error('页面不存在');die;
        }
        /*获取session中的验证码*/
        $str = (session('str'));
        /*获取值*/
        $code = md5(I('code'));
        //查询id
        $users = M('users')->where(array('user_mobi'=>I('user_mobi')))->field('id')->find();
        /*判断验证码是否正确*/
        if($code !=$str){
            $data = array('status'=>2);
            $this ->ajaxReturn($data,'json');
        }
        $password = I('password') ? I('password') : 123456;
        /*执行修改操作*/
        $arr['id']=$users['id'];
        $arr['password']=md5(I('password'));
        $result = M('users')->save($arr);
        /*返回值*/
        if($result){
            $data = array('status' => 1);
        } else {
            $data = array('status' => 0);
        }
        $this->ajaxReturn($data,'json');
    }

    /*修改手机号*/
    public function mobi()
    {
        if(!IS_AJAX){
            $this->error('页面不存在');die;
        }
        /*获取session中的验证码*/
        $str = (session('str'));
        /*获取值*/
        $code = md5(I('code'));
        /*原手机号*/
        $oldPhone = I('user_mobi');
        //查询id
        $users = M('users')->where(array('user_mobi'=>$oldPhone))->field('id')->find();
        /*新手机号*/
        $phone = I('phone');
        /*判断验证码是否正确*/
        if($code !=$str){
            $data = array('status' => 2);
            $this -> ajaxReturn($data, 'json');
        }
        /*执行修改*/
        $arr['id']= $users['id'];
        $arr['user_mobi']= $phone;
        $result = M('users')->save($arr);
        $user = M('users')->where($arr)->field('password', true)->find();
        /*返回值*/
        if($result){
            $data = array('status' => 1);
            session('user',$user);
        }else{
            $data = array('status' => 0);
        }
        $this->ajaxReturn($data, 'json');
    }

}