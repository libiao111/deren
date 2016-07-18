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
    	$this->display('frame');
    }
    public function course(){
        /*分页*/
        $table = 'course';
        $condition = "";
        $tiao = 5;
        $where = "";
        /*调用分页函数返回*/
        $data = pageHandle($table,$condition,$tiao);
        /*查询记录*/
        $result = M('course')->where($where)->limit($data['limit'])->select();
        $this->assign('page',$data['pages']);
        $this->assign('course',$result);
        $this->display("course_management");
    }
    //添加或修改线下课
    public function offLine()
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
        /*反馈数据*/
		if($result){
			$data = array('status'=>1);
		}
		else{
			$data = array('status'=>0);
		}
		$this->ajaxReturn($data,'json');
    }
    //添加或修改视频课
    public function addVideo()
    {
    	if (!IS_AJAX) {
      		  $this->error('页面不存在!');die; 
      	}
      	/*获取值*/
    	$id =I('id');
    	/*获取缩略图路径*/
    	$course_photo =session('arr');
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
     //添加或修改音频课
    public function addAudio()
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
    /*添加或修改线下课课时*/
    public function addLine()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
        $id = I('id');
        /*赋值*/
        $arr = array(
            'class_name'=>I('class_name'),
            'class_time'=>I('class_time'),
            'paixu'=>I('paixu'),
            'course_id'=>I('course_id')
        );
        if ($id) {
            /*修改操作*/
            $arr['id']=$id;
            $result = M('class')->save($arr);
        } else {
            /*添加操作*/
            $result = M('class')->add($arr);
        }
        /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data','json');
    }
    /*添加或修改线视频课时*/
    public function addVideoClass()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
        $id = I('id');
        $video_url =I('video_url'); 
        session('video',$video);
        /*赋值*/
        $arr = array(
            'class_name'=>I('class_name'),
            'class_mins'=>I('class_mins'),
            'paixu'=>I('paixu'),
            'course_id'=>I('course_id')
        );

        if ($id) {
            /*修改操作*/
            $arr['id']=$id;
            $result = M('class')->save($arr);
        } else {
            /*添加操作*/
            $result = M('class')->add($arr);
        }
        /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data','json');
    }
    /*添加或修改音频课课时*/
    public function addClass()
    {
        if (!IS_AJAX) {
            $this->error('页面不存在!');die;
        }
        /*获取课时id*/
        $id = I('id');
        /*音频路径*/
        $video_url = I('video_url'); 
        session('video',$video);
        /*获取轮播图路径*/
        $pho_url =I('pho_url');
        /*赋值*/
        $arr = array(
            'class_name' => I('class_name'),
            'class_mins' => I('class_mins'),
            'paixu'=>I('paixu'),
            'course_id'=>I('course_id')
        );
        /*图片路径赋值给数组$arr*/
        foreach ($pho_url as $va) {
            $arr['bigpho'][] = array(
                'pho_url' => $va
            );
        }
        if ($id) {
            /*修改操作*/
            $arr['id'] = $id;
            $sql = M('bigpho')->where(array('class_id'=>$id))->delete();
            /*先删除对应的图片*/
            $result = D('class')->relation('bigpho')->save($arr);
        } else {
            /*添加操作*/
            $result = D('class')->relation('bigpho')->add($arr);
        }
        /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data','json');
    }
    //删除课时
    public function delClass()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
    	$id = I('id');
		$where=array(
        	'id'  =>array('in',$id)
        );
    	$result = D('class')->relation('bigpho')->where($where)->delete();
        /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data','json');
    	
    }
    /*删除线下课与视频课课程*/
    public function delCourse()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
    	$id = I('id');
    	$where=array(
        	'id'  =>array('in',$id)
  		);
  		/*关联表*/
      	$arr1 = array(
            'class'
        );	
  		$result = D('course')->relation($arr1)->where($where)->delete();
        /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data','json');
    }
    /*删除音频课课程*/
    public function delAudio()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
    	$id = I('id');
    	$where=array(
        	'id'  =>array('in',$id)
  		);
  		/*关联表*/
      	$arr1 = array(
            'class'
        );
  		$result = D('course')->relation($arr1)->where($where)->delete();
        /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data','json');
	}
    /*搜索*/
    public function search()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
    	$type = I('type');
    	$status = I('status');
    	if (!$type) {
    		if (!$status) {
    			$result = M('course')->select();
    		} else {
    			$arr['status'] =$status;
    			$result = M('course')->where($arr)->select();
			}
    	} else {
    		if (!$status) {
    			$arr['type'] = $type;
    			$result = M('course')->select();
    		} else if ($status) {
    			$arr['type']=$type;
    			$arr['status'] =$status;
    			$result = M('course')->where($arr)->select();
			}
    	}
        $this->assign('course',$result);
        
	}




}