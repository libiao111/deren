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
		 // $type = I('type');
		/*获取值*/
    	//$id =I('id');
    	/*获取缩略图路径*/
    	$course_photo =session('course_photo');
        $offline_url = session('offline_url');
        
    	//数组赋值
    	$arr =array(
			//'type'=>I('type'),
	    	'course_name'=>I('course_name'),
	    	//'course_photo'=>$course_photo,
	    	'current_price'=>I('current_price'),
	    	'course_price'=>I('course_price'),
	    	'teach_name'=>I('teach_name'),
	    	//'picture'=>I('picture'),
	    	'addtime'=>I('addtime'),
			'offline_url'=> $offline_url,
	    	'class_num'=>I('class_num'),
	    	//'status'=>I('status')
            
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
            session('offline_url',null);
            session('course_photo',null);
		}
		else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
  	}
    
    /*显示课时*/
    public function Offlineclass()
    {
        $id= I('id');
        $arr = array(
            'course_id'=>$id
        );
        $result = M('class')->where($arr)->order('paixu')->select();
        $this->assign('class',$result);
        $this->display('Index/offline_cousrse_edit');
    } 
    
    /*上传缩略图*/
    public function upload(){
        $width = '300';
        /*上传图片*/
    	$offline_url = uploadHandle($width);
        session('offline_url',$offline_url);
        /*生成缩略图*/
        $course_photo = photo_cut($offline_url, 50);
        session('course_photo',$course_photo);
        $this->course_photo = $course_photo;

    }
    
    /*上传音频视频*/
    public function uploa(){
        $video_url = uploadvideo();
        $this->video_url=$video_url;
    }

}