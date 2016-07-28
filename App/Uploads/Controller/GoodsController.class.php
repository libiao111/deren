<?php
namespace Admin\Controller;
use Common\Controller\CommonController;
/**
* 商品管理
*/
class GoodsController extends CommonController
{

    /*上传图片*/
    public function uploadimg()
    {
        if (!IS_POST) {
            $this->error('页面不存在');
        }
        /* 开始上传 */
        $w = I('w');
        $h = I('h');
        $result = uploadImgHandler($w, $h);
        echo '<script>parent.uploadReturn("'.$result['status'].'","http://www.gkdao.cn/","'.$result['data'].'")</script>';
    }
    
}
