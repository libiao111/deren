<?php 
namespace Common\Controller;
use Think\Controller;
/**
* 登录权限验证
*/
class CommonController extends Controller
{
    
    public function _initialize()
    {
        if (!isset($_SESSION[C('USER_AUTH_KEY')]) || !isset($_SESSION["account"]) || !isset($_SESSION["member_id"])) {
            $this->redirect('home/login/index');
        }

        if (C('USER_AUTH_ON')) {
            $rbac = new \Org\Util\Rbac();
            /* ajax没有权限反馈 */
            if (IS_AJAX && !$rbac->AccessDecision()) {
                $this->ajaxReturn(
                    array(
                        "check" => 1,
                        'text' => '没有权限'
                    ),
                    'json'
                );
            }
            /* 没有权限页面跳转 */
            $rbac->AccessDecision() || $this->error("没有权限");
        }
    }

}