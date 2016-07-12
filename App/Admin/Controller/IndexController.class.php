<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
    
    public function index(){
        /*查询所有课程*/
    	//$arr = M("course")->where(array('id'=>1))->order('id')->find();
    	$result =D('course')->relation('bigpho')->select();
    	p($result);
    	/*$arr = M("course")->order('id')->select();
    	p($arr);*/
        $this->assign('course',$arr);
        $this->display();
    }
    //添加或修改线下课
    public function addcourse()
    {
    	/*if(!IS_AJAX){
      		  $this->error('页面不存在!');die; 
      	}*/
      	/*获取值*/
    	$id =I('id');
    	/*$video_url =I('video_url');
    	$classtime =I('classtime');
    	$course_id =I('course_id');
    	$offline_url =I('offline_url');
    	$type =I('type');
    	*/
    	$video_url ='r2y';
    	$classtime =45;
    	$course_id =7;
    	$offline_url ='sdf';
    	$id=3;
    	$type =3;
    	/*获取图片路径*/
    	$a =session('arr');
    	$a = array(
    		'rgt','yuy','dfrt'
		);
    	//数组赋值
    	/*$arr =array(
			'type'=>I('type'),
	    	'course_name'=>I('course_name'),
	    	'course_photo'=>I('course_photo'),
	    	'current_price'=>I('current_price'),
	    	'course_price'=>I('course_price'),
	    	'teach_name'=>I('teach_name'),
	    	'picture'=>I('picture'),
	    	'class_num'=>I('class_num')
		);*/
		$arr =array(
			'type'=>$type,
	    	'course_name'=>'ty',
	    	'course_photo'=>'df',
	    	'current_price'=>57,
	    	'course_price'=>40,
	    	'teach_name'=>'ae',
	    	'picture'=>'ry7',
	    	'class_num'=>5
		);
		if($id){
			if($type==1){
				/*修改线下课*/
				$arr['id']=$id;
				$arr['offline_url'] =$offline_url;
				$result = M('course')->save($arr);
			}
			else if($type==2){
				/*修改视频课*/
				$arr['id']=$id;
				$arr['video_url']=$video_url;
				$arr['classtime']=$classtime;
				$result = M('course')->save($arr);
			}else if($type==3){
				/*修改音频课*/
				$arr['id']=$id;
				$arr['video_url']=$video_url;
				$arr['classtime']=$classtime;
				/*图片路径赋值给数组$arr*/
				foreach ($a as $va) {
					$arr['bigpho'][]= array(
						'course_id'=>$id,
						'pho_url'=>$va
					);
				}
				p($arr);
				/*先删除对应的图片*/
				$sql = M('bigpho')->where(array('course_id'=>$id))->delete();
				/*执行修改操作*/
				$result =D('course')->relation('bigpho')->save($arr);
			}
		}
		else{
			if($type==1){
				/*添加线下课*/
				$arr['offline_url'] =$offline_url;
				$result = M('course')->add($arr);
			}
			else if($type==2){
				/*添加视频课*/
				$arr['video_url'] = $video_url;
				$arr['classtime'] = $classtime;
				$result = M('course')->add($arr);
			}else if($type==3){
				/*添加音频课*/
				$arr['video_url']=$video_url;
				$arr['classtime']=$classtime;
				/*图片路径赋值给数组$arr*/
				foreach ($a as $va) {
					$arr['bigpho'][] = array(
						'pho_url' => $va
					);
				}
				$result = D('course')->relation('bigpho')->add($arr);
			}
		}
		if($result){
			$data = array('status'=>1);
		}
		else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,json);
    }
    //搜索
    public function search(){
    	$type = I('type');
    	$arr = array(
    		'type'=>$type
		);
    }
}
