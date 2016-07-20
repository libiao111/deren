<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class OffLineController extends Controller
{
    
    //添加或修改线下课
    public function index()
    {
    	if(!IS_AJAX){
      		  $this->error('页面不存在!');die; 
      	}
      	/*获取值*/
    	$id =I('id');
    	/*获取缩略图路径*/
    	$course_photo =session('arr');
    	//数组赋值
    	$arr =array(
			'type'=>I('type'),
	    	'course_name'=>I('course_name'),
	    	'course_photo'=>I('course_photo'),
	    	'current_price'=>I('current_price'),
	    	'course_price'=>I('course_price'),
	    	'teach_name'=>I('teach_name'),
	    	'picture'=>I('picture'),
	    	'addtime'=>I('addtime'),
			'offline_url'=>I('offline_url'),
	    	'class_num'=>I('class_num'),
	    	'status'=>I('status')
		);
		if ($id) {
			/*修改线下课*/
			$arr['id']=$id;
			$result = M('course')->save($arr);
		} else {
			/*添加线下课*/
			$result = M('course')->add($arr);
		}
        /*反馈数据*/
		if($result){
			$data = array('status'=>1);
		}
		else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
  	}
    public function aa(){
    	$file = $_GET['b'];
    	//p($file);
		$width = 100;
    	$photo = uploadHandle($file, $width, $height =null);
    	//P($photo);
    }
    public function upload(){
	/*$file = $_GET['b'];
	p($file);*/
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Public/resource/'; // 设置附件上传根目录
    $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
        echo'上传失败';
    }else{// 上传成功
        $this->success('上传成功！');
    }
}
}