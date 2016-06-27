<?php
namespace Home\Controller;
use Think\Controller;
/**
* 管理端
*/
class IndexController extends Controller
{
    
    public function index(){
        $this->show('管理端');
    }

}
