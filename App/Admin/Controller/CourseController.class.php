<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理端
*/
class CourseController extends Controller
{
    public function index()
    {
        /*$type = I('type');
        if($type==1){

        }else if($type==2){

        }else if($type==3){

        }*/
    }
    /*默认显示所有*/
    public function course(){
        
        //搜索
        $type = I('type');
        $status = I('status');
        $where="";
        /*分页*/
        $table = 'course';
        $condition = "";
        $tiao = 5;
        /*调用分页函数返回*/
        $data = pageHandle($table,$condition,$tiao);
        /*按类型查询*/
        if ($type) {
            $where['type'] = $type;
        }
        /*按状态查询*/
        if ($status) {
            $where['status']=$status;
        }
        $this->type=$type;
        $this->status=$status;
        /*查询记录*/
        $result = M('course')->where($where)->limit($data['limit'])->select();
        $this->assign('page',$data['pages']['pages']);
        $this->assign('course',$result);
        $this->display("index/course_management");
    }
     /*搜索*/
    /*public function search()
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

    }*/
    /*启用状态*/
    public function enablestatus()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
        $id = I('id');
        $where = array(
            'id'=>array('in',$id),
        );
        $arr = array(
            'status'=>2
        );
        $result = M('course')->where($where)->save($arr);
         /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
    }
    /*停用状态*/
    public function disablestatus()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
        $id = I('id');
        $where = array(
            'id'=>array('in',$id)
        );
        $arr = array(
            'status'=>1
        );
        $result = M('course')->where($where)->save($arr);
         /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
    }
    /*删除课程*/
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
        $arr = array(
          'class'
        );
        /*关联查询课时表id*/    
        $sql = D('course')->relation($arr)->where($where)->select();
        foreach ($sql as $k => $v) {
            foreach ($v['class'] as $key => $va) {
                /*课时id赋值数组*/
               $arr1[] = $va['id'];
            }
        }
        $where1= array(
            'id'=>array('in',$arr1)
        );
        $sql2 = D('class')->relation('bigpho')->where($where1)->delete();
        /*先删除子类*/
        if($sql2){
            $result = M('course')->where($where)->delete();
        }
        /*反馈数据*/
        if ($result) {
            $data = array('status'=>1); 
        } else {
            $data = array('status'=>0);
        }
        $this->ajaxReturn($data,'json');
    }
   
}