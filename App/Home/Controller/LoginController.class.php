<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller {
	/*
	用户登录
	*/
	public function login(){
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
		}else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
	} 
	/*
	注册时失去焦点验证手机号是否存在
	*/
	public function register1(){
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
	public function sms(){
		if(IS_AJAX){
			$this->error('页面不存在!');die;
		}
		//获取手机号
		$phone = I('phone');
		//生成六位随机数
		$chars = str_repeat('0123456789',6);
		//打乱重组
		$str = str_shuffle($chars);
		session('str',$str);
		//$str = substr($chars,0,6);
		$data['code'] = $str;
		$data['phone'] = $phone;
		pullCode($data);
		if($data){
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
		}
		
	}
	/*
	用户注册
	*/
	public function register(){
		if(IS_AJAX){
			$this->error('页面不存在!');die;
		}
		//session 获取验证码
		$str = session('str');
		$sql = M('users')->where(array('user_mobi'=>$user_mobi))->select();
		if($sql){
			$data = array('status'=>2);
			$this->ajaxReturn($data,'json');
		}else if(I('code')==$str || I('password')==I('password2'){
			$arr = array(
				'password' 		=>md5(I('password')),
				'user_mobi'		=>I('user_mobi'),
			);
			$result = M('users')->add($arr);
		}
		if($result){
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
	}



}
?>
