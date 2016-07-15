<?php
namespace Home\Controller;
use Think\Controller;
/**
* 公用控制器
*/
class OpenController extends Controller
{

	public function index()
	{
		$this->entry();
	}
	/* 显示关注公众号二维码 */
	public function entry()
	{
		$this->display('Index/entry');
	}
}