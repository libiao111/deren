<?php
namespace Home\Controller;
use Think\Controller;
/**
* 公用控制器
*/
class OpenController extends Controller
{
    // private
    /* 显示关注公众号二维码 */
    private function entry()
    {
        $this->display('Index/entry');
    }

    /* 显示扫码 */
    public function index()
    {
        $this->entry();
    }
}