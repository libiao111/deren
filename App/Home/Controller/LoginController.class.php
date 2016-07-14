<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller 
{
	/*
	用户登录
	*/
	public function loginhandle()
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
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
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
		/*session 获取验证码*/
		$str = session('str');
		/*赋值变量*/
		$code = md5(I('code'));
		$username = '李飞';
		
		/*判断验证码是否正确*/
		if($code !=$str){
			$data = array('status'=>2);
			$this -> ajaxReturn($data,'json');
		}

		$password = I('password') ? I('password') : 123456;
		$arr = array(
			'password' 		=> md5($password),
			'user_mobi'		=> I('user_mobi'),
			'username'		=> $username,
			'sex' 			=> 1,
			'user_photo'	=> 'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png'
		);
		$result = M('users')->add($arr);
		/*返回状态*/
		if ($result) {
			$data = array('status'=>1);
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
        	$data = array('status'=>1);
        } else {
        	$data = array('status'=>0);
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
        	$data = array('status'=>2);
			$this -> ajaxReturn($data,'json');
        }
        /*执行修改*/
        $arr['id']= $users['id'];
    	$arr['user_mobi']= $phone;
    	$result = M('users')->save($arr);
        $user = M('users')->where($arr)->field('password', true)->find();
        /*返回值*/
        if($result){
        	$data = array('status'=>1);
        	session('user',$user);
        }else{
        	$data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
    }

}
?>
