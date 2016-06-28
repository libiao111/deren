<?php
namespace Home\Controller;
use Think\Controller;
/**
* 用户端
*/

header('content-type:text/html;charset =utf-8');
class IndexController extends Controller
{
    public function index(){

    	$arr = D("course")->relation('class')->order('id')->select();
		$arr = node_merge($arr);
        p($arr);
        $this->assign('course',$arr);
        $this->display();
    }
    //线下课
    public function offLine(){
    	$arr = array(
    		'id'=>I('id')	
		);
		$result = D("course")->relation('class')->where($arr)->order('id')->select();
		//$arr = node_merge($arr);
    	$this->assign('course',$result);
    	$this->display();
    }
    //视频课
    public function video(){
    	if(IS_AJAX){
    		$this->error('页面不存在');die;
    	}
    	//获取id
    	$arr = array(
    		'id'=>I('id')	
		);
		//关联查询
		$result = D("course")->relation('class')->where($arr)->order('id')->select();
		//$arr = node_merge($arr);
    	$this->assign('course',$result);
    	$this->display();
    }
    //音频课
    public function voice(){
    	if(IS_AJAX){
    		$this->error('页面不存在');die;
    	}
    	//获取id
    	$arr = array(
    		'id'=>I('id')	
		);
		//关联查询
		$result = D("course")->relation('class')->where($arr)->order('id')->select();
		//$arr = node_merge($arr);
    	$this->assign('course',$result);
    	$this->display();
    }
    //课程详情
    public function details(){
    	if(IS_AJAX){
    		$this->error('页面不存在');die;
    	}
    	$arr = array(
    		'id'=>I('id')
    		);
    	//关联查询
		$result = D("course")->relation('class')->where($arr)->order('id')->select();
		//$arr = node_merge($arr);
    	$this->assign('course',$result);
    	$this->display();
    }




















}
