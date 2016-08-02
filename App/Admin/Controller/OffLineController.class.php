<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 线下课
*/
class OffLineController extends Controller
{
    // private
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
    // form post return
    private function selfReturn($return)
    {
        $callback = I('callback');
        $return = json_encode($return);
        exit("<script>parent.$callback($return)</script>");
    }



    /* 页面(新建编辑) */
    public function index()
    {
        $id = I('id');
        $info = array();
        if ($id !== '') {
            $info = D('course')->relation('class')->where(array('id' => $id))->find();
        }

        $this->assign('va', $info);
        $this->display('Index/course_edit_offline');
    } 
    

    /* 页面(新建编辑) */
    public function newOfflineHandler()
    {
        $this->checkPost();
        /* 数组赋值 */
        $data =array(
            'type'          => 1,
            'status'        => 2,
            'course_name'   => I('course_name'),
            'current_price' => I('current_price'),
            'course_price'  => I('course_price'),
            'teach_name'    => I('teach_name'),
            'class_num'     => I('class_num'),
            'class_time'    => I('class_time'),
            'picture'       => $_POST['picture']
        );

        /* 上传封面 */
        $img = $_FILES['course_photo'];
        if (!$img['error']) {
            $load = loadOneImageHandler($img);
            if ($load['status']) {
                /* 成功 */
                $img = $load['assets'];
                image_cut($img, 320, 180);
                $data['course_photo'] = $img;
            } else {
                /* 失败 */
                $return = array(
                    'status' => 0,
                    'info' => $load['error']
                );
                $this->selfReturn($return);
            }
        }

        /* 执行保存 */
        $id = I('id');
        if ($id !== '') {
            $data['id'] = $id;
            $data['udate'] = time();
            $result = M('course')->save($data);
        } else {
            $data['adate'] = time();
            $result = M('course')->add($data);
        }

        /*反馈数据*/
        $return = array(
            'status' => $result ? 1 : 0,
            'info' => $id ? '编辑线下课' : '新建线下课',
            'course_id' => $id ? $id : $result
        );
        $this->selfReturn($return);
    }


    /* 添加课节 */
    public function newOfflineDot()
    {
        $this->checkPost();
        $data = array(
            'course_id' => I('course_id'),
            'class_name' => I('class_name'),
            'class_day' => I('class_day'),
            'class_hour' => I('class_hour'),
            'class_min' => I('class_min')
        );

        /* 执行保存 */
        $id = I('open_id');
        if ($id !== '') {
            $data['id'] = $id;
            $data['udate'] = time();
            $result = M('class')->save($data);
        } else {
            $data['adate'] = time();
            $result = M('class')->add($data);
        }

        /*反馈数据*/
        $return = array(
            'status' => $result ? 1 : 0,
            'info' => $id ? '编辑课节' : '新建课节'
        );
        $this->selfReturn($return);
    }


    /* 获取课节信息 */
    public function pullOfflineDot()
    {
        $this->checkAjax();
        $id = I('id');
        $result = M('class')->where(array('id' => $id))->find();
        if ($result) {
            $data = array(
                'open_id'    => $result['id'],
                'course_id'  => $result['course_id'],
                'class_name' => $result['class_name'],
                'class_day'  => $result['class_day'],
                'class_hour' => $result['class_hour'],
                'class_min'  => $result['class_min']
            );
        }
        $return = array(
            'data' => $data,
            'status' => $result ? 1:0
        );
        $this->ajaxReturn($return, 'json');
    }


    /* 删除课节 */
    public function deleDotList()
    {
        $this->checkAjax();
        $id = I('id');
        $result = M('class')->where(array('id' => $id))->delete();
        $return = array(
            'status' => $result ? 1 : 0,
            'info' => '删除课节'
        );
        $this->ajaxReturn($return, 'json');
    }

}