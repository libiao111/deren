<?php
namespace Admin\Controller;
use Think\Controller;
/*
* 管理端
*/
class ClassController extends Controller
{
    public function index()
    {
        
    }
    /*添加或修改线下课课时*/
    public function addOffLine()
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
    /*添加或修改视频课时*/
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
    public function addAudioClass()
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
            'id'  =>$id
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
}