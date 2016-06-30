<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller 
{
	/*
	用户登录
	*/
	public function login()
	{
		if(!session('user')){
			if(IS_AJAX){
				$this->error('页面不存在!');die;
			}
			$arr = array(
				'user_mobi' =>I('user_mobi'),
				'password'	=>I('password'),
			);
			$result = M('users')->where($arr)->find();
			if($result){
				$data = array('status' =>1);
				session('user',$result);
			}else{
				$data = array('status'=>0);
			}
			$this->ajaxReturn($data,'json');
		} else {
			$this->dispaly('login');die;
		}
	}
	/*
	注册时失去焦点验证手机号是否存在
	*/
	public function register1()
	{
		if(IS_AJAX){
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
		/*赋值变量*/
		$phone = I('phone');
		/*生成六位随机数*/
		$str = rand('100000','999999');
		$data['code'] = $str;
		$data['phone'] = $phone;
		$code = pullCode($data);
		/*返回状态*/
		if($code){
			$data = array('status'=>1);
			session('str',md5($str));
		}else{
			$data = array('status'=>0);
		}
		
	}
	/*
	用户注册
	*/
	public function register()
	{
		if (IS_AJAX) {
			$this->error('页面不存在!');die;
		}
		/*session 获取验证码*/
		$str = (session('str'));
		/*赋值变量*/
		$code = md5(I('code'));
		$password = I('password');
		$user_mobi = I('user_mobi');
		/*查询手机号是否存在*/
		$sql = M('users')->where(array('user_mobi'=>$user_mobi))->select();
		/*判断验证码是否正确*/
		if($code !=$str){
			$data = array('status'=>2);
			$this = ajaxReturn($data,'json');
		}
		/*判断条件成立，添加记录*/
		if (!$sql && $password !="") {
			$arr = array(
				'password' 		=>md5($password),
				'user_mobi'		=>$user_mobi,
			);
			$result = M('users')->add($arr);
		}
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
    	if(IS_AJAX){
    		$this->error('页面不存在');die;
    	}
        /*获取session中的验证码*/
        $str = (session('str'));
        /*获取值*/
    	$id = I('id');
        $code = md5(I('code'));
        $phone = I('phone');
        $password = I('password');
        /*查询手机号是否存在*/
        $arr = array(
            'user_mobi' =>$phone
        );
        $sql = M('users')->where($arr)->select();
        /*判断验证码是否正确*/
		if(!$code = $str){
        	$data = array('status'=>2);
			$this = ajaxReturn($data,'json');
        }
        /*执行修改操作*/
        if(!$sql && $password!=""){
            $arr['id']=$id;
            $arr['password']=md5($password);
            $result = M('users')->save($arr);
        }
        /*返回值*/
        if($result){
        	$data = array('status'=>1);
        } else {
        	$data = array('status'=>0);
        }
    	$this->ajaxReturn($data,'json')
    }
    /*修改手机号*/
    public function mobi()
    {
    	if(IS_AJAX){
    		$this->error('页面不存在');die;
    	}
    	/*获取session中的验证码*/
        $str = (session('str'));
        /*获取值*/
    	$id = I('id');
        $code = md5(I('code'));
        $phone = I('phone');
        /*查询手机号是否存在*/
        $arr = array(
            'user_mobi' =>$phone
        );
        $sql = M('users')->where($arr)->select();
        /*判断验证码是否正确*/
		if(!$code = $str){
        	$data = array('status'=>2);
			$this = ajaxReturn($data,'json');
        }
        /*执行修改*/
        if($sql){
        	$arr['id']=>$id;
        	$arr['user_mobi']=>$phone;
        	$result = M('users')->save($arr);
        }
        /*返回值*/
        if($result){
        	$data = array('status'=>1);
        }else{
        	$data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
    }

}
?>
