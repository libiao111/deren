<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 视频
*/
class VideoController extends Controller
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


    /* 页面(新建编辑) */
    public function index()
    {
        $id = I('id');
        $info = array();
        if ($id !== '') {
            $info = D('course')->relation('class')->where(array('id' => $id))->find();
        }

        $this->assign('va', $info);
        $this->display('Index/course_edit_video');
    }


    /* 提交(新建编辑) */
    public function newVideoHandler()
    {
        $this->checkPost();
        /* 数组赋值 */
        $data =array(
            'type'          => 2,
            'status'        => 1,
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
            $img = loadOneImageHandler($img);
            image_cut($img, 320, 180);
            $data['course_photo'] = $img;
        }

        /* 执行保存 */
        $id = I('id');
        if ($id !== '') {
            $data['id'] = $id;
            $result = M('course')->save($data);
        } else {
            $data['addtime'] = date('Y-m-d H:i:s');
            $result = M('course')->add($data);
        }

        /*反馈数据*/
        $return = array(
            'status' => $result ? 1 : 0,
            'info' => $id ? '编辑视频课' : '新建视频课',
            'course_id' => $id ? $id : $result
        );
        $return = json_encode($return);
        echo "<script>parent.returnHandler($return)</script>";
    }


    /* 添加课节 */
    public function newVideoDot()
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
        $return = json_encode($return);
        echo "<script>parent.returnDotHandler($return)</script>";
    }


    /* 获取课节信息 */
    public function pullVideoDot()
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


}