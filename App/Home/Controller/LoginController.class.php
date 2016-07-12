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
		$str = (session('str'));
		/*赋值变量*/
		$code = md5(I('code'));
		$username = '李飞飞';
		/*查询手机号是否存在*/
		$sql = M('users')->where(array('user_mobi'=>$user_mobi))->select();
		/*判断验证码是否正确*/
		if($code !=$str){
			$data = array('status'=>2);
			$this -> ajaxReturn($data,'json');
		}
		/*判断条件成立，添加记录*/
		if (!$sql && $password !="") {
			$arr = array(
				'password' 		=>md5(I('password')),
				'user_mobi'		=>I('user_mobi'),
				'username'		=>$username,
				'user_photo'	=>'http://www.gkdao.cn/resource/2016-07-05/20160705183330-9879.png'
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
    	if(!IS_AJAX){
    		$this->error('页面不存在');die;
    	}
        /*获取session中的验证码*/
        $str = (session('str'));
        /*获取值*/
    	$code = md5(I('code'));
        /*查询手机号是否存在*/
        $arr = array(
            'user_mobi' =>I('user_mobi')
        );
        $sql = M('users')->where($arr)->select();
        /*判断验证码是否正确*/
		if($code !=$str){
        	$data = array('status'=>2);
			$this ->ajaxReturn($data,'json');
        }
        /*执行修改操作*/
        if($sql && $password!=""){
            $arr['id']=I('id');
            $arr['password']=md5(I('password'));
            $result = M('users')->save($arr);
        }
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
        $phone1 = I('user_mobi');
        /*要改的手机号*/
        $phone2 = I('phone');
        /*查询原手机号是否存在*/
        $arr = array(
            'user_mobi' =>$phone1
        );
        $sql = M('users')->where($arr)->select();
        /*查询新手机号是否存在*/
        $arr2 = array(
        	'user_mobi' =>$phone2
    	);
    	$sql2 = M('users')->where($arr2)->select();
        /*判断验证码是否正确*/
		if($code !=$str){
        	$data = array('status'=>2);
			$this -> ajaxReturn($data,'json');
        }
        /*执行修改*/
        if($sql && !$sql2){
        	$arr1['id']= I('id');
        	$arr1['user_mobi']= $phone2;
        	$result = M('users')->save($arr1);
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
