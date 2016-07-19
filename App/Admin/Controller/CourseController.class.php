<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class CourseController extends Controller
{
    /*public function index()
    {
        $type = I('type');
        if($type==1){

        }else if($type==2){

        }else if($type==3){

        }
    }*/
    /*默认显示所有*/
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
        $this->assign('course',$arr);
        $this->display("course_management");
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
    /*停启用状态*/
    public function status()
    {
        $id = I('id');
        $status = I('status');
        $arr = array(
            'id'=>array('in',$id),
            'status'=>$status
        );
        $result = M('course')->save($arr);
    }
    /*删除线下课与视频课课程*/
    public function delCourse()
    {
        /*if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }*/
        /*$id = I('id');*/
        $id= array(1,2,3,5,6);
        $where=array(
            'id'  =>array('in',$id)
        );
        p($where);
        /*关联表*/
        $arr = array(
          'class'
        );    
        $result = D('course')->relation($arr)->where($where)->field()->select();
        p($result);
        /*反馈数据*/
        /*if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn('$data','json');*/
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
}