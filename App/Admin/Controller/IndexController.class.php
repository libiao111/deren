<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
    
    public function index(){
    	$table = 'course';
    	$tiao = 5;
    	pageHandle($table,$tiao);
        /*查询所有课程*/
    	$arr = M("course")->order('id')->select();
    	$this->assign('course',$data);
    	$this->assign('course',$arr);
        $this->display();
    }
    //添加或修改线下课
    public function offline()
    {
    	if(!IS_AJAX){
      		  $this->error('页面不存在!');die; 
      	}
      	/*获取值*/
    	$id =I('id');
    	/*获取图片路径*/
    	$a =session('arr');
    	//数组赋值
    	$arr =array(
			'type'=>I('type'),
	    	'course_name'=>I('course_name'),
	    	'course_photo'=>I('course_photo'),
	    	'current_price'=>I('current_price'),
	    	'course_price'=>I('course_price'),
	    	'teach_name'=>I('teach_name'),
	    	'picture'=>I('picture'),
			'offline_url'=>I('offline_url'),
	    	'class_num'=>I('class_num')
		);
		if ($id) {
			/*修改线下课*/
			$arr['id']=$id;
			$result = M('course')->save($arr);
		} else {
			/*添加线下课*/
			$result = M('course')->add($arr);
		}
		if($result){
			$data = array('status'=>1);
		}
		else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,json);
    }
     //添加或修改视频课
    public function addcourse()
    {
    	if(!IS_AJAX){
      		  $this->error('页面不存在!');die; 
      	}
      	/*获取值*/
    	$id =I('id');
    	/*获取图片路径*/
    	$a =session('arr');
    	//数组赋值
    	$arr =array(
			'type'=>I('type'),
	    	'course_name'=>I('course_name'),
	    	'course_photo'=>I('course_photo'),
	    	'current_price'=>I('current_price'),
	    	'course_price'=>I('course_price'),
	    	'teach_name'=>I('teach_name'),
	    	'video_url' =I('video_url'),
	    	'classtime' =I('classtime'),
	    	'picture'=>I('picture'),
	    	'class_num'=>I('class_num')
		);
		if($id){
			/*修改视频课*/
			$arr['id']=$id;
			$result = M('course')->save($arr);
		}else{
			/*添加视频课*/
			$result = M('course')->add($arr);
		}
		if($result){
			$data = array('status'=>1);
		}
		else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,json);
    }
     //添加或修改线下课
    public function addcourse()
    {
    	if(!IS_AJAX){
      		  $this->error('页面不存在!');die; 
      	}
      	/*获取值*/
    	$id =I('id');
    	/*获取图片路径*/
    	$a =session('arr');
    	//数组赋值
    	$arr =array(
			'type'=>I('type'),
	    	'course_name'=>I('course_name'),
	    	'course_photo'=>I('course_photo'),
	    	'current_price'=>I('current_price'),
	    	'course_price'=>I('course_price'),
	    	'teach_name'=>I('teach_name'),
	    	'picture'=>I('picture'),
	    	'video_url'=>I('video_url'),
			'classtime'=>I('classtime'),
	    	'class_num'=>I('class_num')
		);
		if($id){
			$arr['id']=$id;
			/*图片路径赋值给数组$arr*/
			foreach ($a as $va) {
				$arr['bigpho'][]= array(
					'course_id'=>$id,
					'pho_url'=>$va
				);
			}
			/*先删除对应的图片*/
			$sql = M('bigpho')->where(array('course_id'=>$id))->delete();
			/*执行修改操作*/
			$result =D('course')->relation('bigpho')->save($arr);
		}else{
			/*图片路径赋值给数组$arr*/
			foreach ($a as $va) {
				$arr['bigpho'][] = array(
					'pho_url' => $va
				);
			}
			$result = D('course')->relation('bigpho')->add($arr);
		}
		if($result){
			$data = array('status'=>1);
		}
		else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,json);
    }
    //删除
    public function deleteCourse(){
    	$id = I('id');
    	//$sql = D('course')->relation()->where()->
    }
    //搜索
    public function search(){
    	$type = I('type');
    	$arr = array(
    		'type'=>$type
		);
    }
}
