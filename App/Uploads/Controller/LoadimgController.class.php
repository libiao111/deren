<?php
namespace Uploads\Controller;
use Think\Controller;
/**
* 
*/
class LoadimgController extends Controller
{
    public function index(){

    }
	/*上传轮播图*/
    public function upload() {

        if (!IS_POST) {
            $this->error('页面不存在');
        }
        /* 开始上传 */
        $result = uploadImgHandler();
        p($result);
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
            $data = './Public/resource/'.$data;
        } else {
            $data = $data;
        }
        /* 输出调用反馈function */
         echo '<script type="text/javascript">parent.uploadReturn("'.$result['status'].'","'.$data.'")</script>';
    }
	
}
?>