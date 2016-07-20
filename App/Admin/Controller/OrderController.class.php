<?php
namespace Admin/Controller;
use Think/Controller;
class OrderCotroller extends Controller{
	public function index(){
		$users_id = I('users_id');
		$arr = array(
			''
		);
		$result = M('ordera')->where()->select();
	}
}
?>