<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 音频
*/
class AudioController extends Controller
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
        $this->display('Index/course_edit_audio');
    }

    //添加或修改音频课
    public function newAudioHandler()
    {
        $this->checkPost();
        /* 数组赋值 */
        $data =array(
            'type'          => 3,
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
            $result = M('course')->save($data);
        } else {
            $data['addtime'] = date('Y-m-d H:i:s');
            $result = M('course')->add($data);
        }

        /*反馈数据*/
        $return = array(
            'status' => $result ? 1 : 0,
            'info' => $id ? '编辑音频课' : '新建音频课',
            'course_id' => $id ? $id : $result
        );
        $this->selfReturn($return);
    }


    /* 添加课节 */
    public function newAudioDot()
    {
        $this->checkPost();
        $data = array(
            'course_id'  => I('course_id'),
            'class_name' => I('class_name'),
            'class_hour' => I('class_hour'),
            'class_min'  => I('class_min')
        );

        /* 上传音频 */
        $aud = $_FILES['assets'];
        if (!$aud['error']) {
            $load = loadAudioHandler($aud);
            if ($load['status']) {
                /* 成功 */
                $aud = $load['assets'];
                $data['assets_url'] = $aud;
            } else {
                /* 失败 */
                $return = array(
                    'status' => 0,
                    'info' => $load['error']
                );
                $this->selfReturn($return);
            }
        }

        /* 重组(去除空的/不完整的文件) */
        $check = $_FILES['class_img'];
        $loadNum = 0;
        $img = array();
        foreach ($check['error'] as $k => $va) {
            if (!$va) {
                $img['name'][] = $check['name'][$k];
                $img['type'][] = $check['type'][$k];
                $img['tmp_name'][] = $check['tmp_name'][$k];
                $img['error'][] = $check['error'][$k];
                $img['size'][] = $check['size'][$k];
                /* 记录旧KEY和新KEY */
                $upImgKey[$k] = $loadNum;
                $loadNum ++;
            }
        }

        /* 执行上传 */
        if ($loadNum) {
            $load = loadImageHandler($img);
            if ($load['status']) {
                /* 成功 */
                $newImg = $load['assets'];
                foreach ($newImg as $key => $va) {
                    image_cut($va, 320, 180);
                }
            } else {
                /* 失败 */
                $return = array(
                    'status' => 0,
                    'info' => $load['error']
                );
                $this->selfReturn($return);
            }
        }

        /* KEY组合重新排序 */
        $img = I('class_image');
        foreach ($upImgKey as $k => $v) {
            $img[$k] = $newImg[$v];
        }

        /* 赋值数组 */
        foreach ($img as $k => $va) {
            if ($va) {
                $item = array(
                    'course_id' => $data['course_id'],
                    'pho_url' => $va
                );
                $data['img'][] = $item;
            }
        }
        
        /* 执行保存 */
        $id = I('open_id');
        if ($id !== '') {
            $data['id'] = $id;
            $data['udate'] = time();
            M('class_img')->where(array('class_id' => $id))->delete();
            $result = D('class')->relation('img')->save($data);
        } else {
            $data['adate'] = time();
            $result = D('class')->relation('img')->add($data);
        }

        /*反馈数据*/
        $return = array(
            'status' => $result ? 1 : 0,
            'info' => $id ? '编辑课节' : '新建课节'
        );
        $this->selfReturn($return);
    }


    /* 获取课节信息 */
    public function pullAudioDot()
    {
        $this->checkAjax();
        $id = I('id');
        $result = D('class')->relation('img')->where(array('id' => $id))->find();
        if ($result) {
            $data = array(
                'open_id'    => $result['id'],
                'course_id'  => $result['course_id'],
                'class_name' => $result['class_name'],
                'class_hour' => $result['class_hour'],
                'class_min'  => $result['class_min'],
                'image'      => $result['img']
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
        $result = D('class')->relation('img')->where(array('id' => $id))->delete();
        $return = array(
            'status' => $result ? 1 : 0,
            'info' => '删除课节'
        );
        $this->ajaxReturn($return, 'json');
    }


}