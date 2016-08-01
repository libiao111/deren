<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 课程列表
*/
class CourseController extends Controller
{
    // check
    // check post
    private function checkPost()
    {
        if (!IS_POST) {
            $this->error('页面不存在');
        }
    }
    // check ajax
    private function checkAjax()
    {
        if (!IS_AJAX) {
            $this->error('页面不存在');
        }
    }


    /* 列表 */
    public function index()
    {
        /* 筛选 */
        $condition = array();
        $type = I('type');
        $status = I('status');
        $this->type = $type ? $condition['type'] = $type: '';
        $this->status = $status ? $condition['status'] = $status: '';

        /* 页码 */
        $page = pageHandle('course',$condition, 5);
        $limit = $page['limit'];
        
        /*查询记录*/
        $result = M('course')->where($condition)->limit($limit)->select();

        $this->assign('course',$result);
        $this->assign('page',$page['pages']);
        $this->display("Index/course");
    }

    /* 启用状态 */
    public function startHandler()
    {
        $this->checkAjax();
        $id = I('id');
        $in = array('id' => array('in', $id));
        $result = M('course')->where($in)->save(array('status' => 2));
        
        /*反馈数据*/
        $data = array('status'=> $result ? 1:0);
        $this->ajaxReturn($data,'json');
    }

    /* 停用状态 */
    public function stopHandler()
    {
        $this->checkAjax();
        $id = I('id');
        $in = array('id' => array('in', $id));
        $result = M('course')->where($in)->save(array('status' => 1));

        /*反馈数据*/
        $data = array('status'=> $result ? 1:0);
        $this->ajaxReturn($data,'json');
    }

    /* 删除课程 */
    public function deleCourseHandler()
    {
        $this->checkAjax();
        
        $id = I('id');
        $in = array('id' => array('in', $id));
    
        /*关联查询课时表id*/    
        $sql = D('course')->relation('class')->where($in)->select();
        foreach ($sql as $k => $v) {
            foreach ($v['class'] as $key => $va) {
                /*课时id赋值数组*/
               $arr1[] = $va['id'];
            }
        }

        /* 删除子类 */
        if($arr1){
            $where1= array('id' => array('in', $arr1));
            $sql2 = D('class')->relation('bigpho')->where($where1)->delete();
        }

        /* 删除课程 */
        $result = M('course')->where($where)->delete();

        /* 反馈数据 */
        $data = array('status'=> $result ? 1:0);
        $this->ajaxReturn($data,'json');
    }
   
}