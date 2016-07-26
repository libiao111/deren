<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class VideoController extends Controller
{
 	//添加或修改视频课
    public function index()
    {
    	if (!IS_AJAX) {
      		  $this->error('页面不存在!');die; 
      	}
      	/*获取值*/
    	$id =I('id');
    	/*获取缩略图路径*/
    	$course_photo =session('course_photo');
        /*获取视频地址*/
        $video_url = session('video_url');
    	//数组赋值
    	$arr =array(
			'type' => I('type'),
	    	'course_name' => I('course_name'),
	    	'course_photo' => $course_photo,
	    	'current_price' => I('current_price'),
	    	'course_price' => I('course_price'),
	    	'teach_name' => I('teach_name'),
	    	'video_url' => $video_url,
	    	'classtime' =>I('classtime'),
	    	'picture' => I('picture'),
	    	'class_num' => I('class_num')
		);
		if($id){
			/*修改视频课*/
			$arr['id']=$id;
			$result = M('course')->save($arr);
		}else{
			/*添加视频课*/
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
    /*显示视频课时*/
    public function Videoclass()
    {
		
        $id= I('id');
        $arr = array(
            'course_id'=>$id
        );
        $result = M('class')->where($arr)->order('paixu')->select();
        $this->assign('class',$result);
        $this->display('index/video_cousrse_edit');
    } 
}