<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
    /*默认显示页*/
    public function index()
    {
    	$this->display('login');
    }
    
}