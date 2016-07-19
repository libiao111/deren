<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class AudioController extends Controller
{
    //添加或修改音频课
    public function index()
    {
    	if(!IS_AJAX){
      		  $this->error('页面不存在!');die; 
      	}
      	/*获取课程id*/
    	$id =I('id');
    	/*获取缩略图路径*/
    	$course_photo =session('arr');
        /*获取视频地址*/
        $video_url = session('video_url');
        /*获取轮播图路径*/
        $pho_url =I('pho_url');
    	//数组赋值
    	$arr =array(
			'type'=>I('type'),
	    	'course_name'=>I('course_name'),
	    	'course_photo'=>$course_photo,
	    	'current_price'=>I('current_price'),
	    	'course_price'=>I('course_price'),
	    	'teach_name'=>I('teach_name'),
	    	'picture'=>I('picture'),
	    	'video_url'=>$video_url,
			'classtime'=>I('classtime'),
	    	'class_num'=>I('class_num')
		);
		if($id){
			$arr['id']=$id;
			/*执行修改操作*/
			$result =M('course')->save($arr);
		}else{
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
  
   
}