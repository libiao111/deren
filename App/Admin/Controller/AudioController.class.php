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
    	$course_photo =session('course_photo ');
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
	    	'class_num'=>I('class_num'),
	    	'status'=>I('status')
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
    /*显示音频课课时*/
     public function Audioclass()
    {
        $id= I('id');
        $arr = array(
            'course_id'=>$id
        );
        $result = M('class')->where($arr)->order('paixu')->select();
        $this->assign('class',$result);
        $this->display('index/Audio_cousrse_edit');
    } 
  	/*上传轮播图*/
    public function upload() {

        if (!IS_POST) {
            $this->error('页面不存在');
        }
        /* 开始上传 */
        $result = uploadImgHandler();
        /* 写入SESSION */
        $data = $result['data'];
        
        if ($result['status']) {
            $num = I('num');
            if ($num >= 0) {
                $img = session('uploadimg');
                $img[$num] = $data;
                session('uploadimg', $img);
            } else {
                session('uploadimg', $data);
            }
            $data = __ROOT__.'/Public/resource/'.$data;
        } else {
            $data = $data;
        }
        /* 输出调用反馈function */
         echo '<script type="text/javascript">parent.uploadReturn("'.$result['status'].'","'.$data.'")</script>';
    }
   
}