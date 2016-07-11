<?php 
namespace Upload\Controller;
use Think\Controller;
/**
* 上传图片处理
*/
class LoadimgController extends Controller
{
	/*public function _initialize() {
		if (!isset($_SESSION[C('USER_AUTH_KEY')]) || !isset($_SESSION["account"]) || !isset($_SESSION["member_id"])) {
			$this->error('页面不存在');
		}
	}*/

	/*显示选择图片*/
	public function sele() {
		if (I('id')) {
			$this->redirect('result', array('name' => I('name'), 'imgnum' => I('imgnum')));
		}
		if (I('name') && I('name') != 'arr') {
			unset($_SESSION[I('name')]);
		} else if(I('name') != 'arr') {
			unset($_SESSION['fmimg']);
		}
		if (I('name') == 'arr') {
			if (I('imgnum') == '') {
				unset($_SESSION['arr']);
			} else {
				unset($_SESSION['arr'][I('imgnum')]);
			}
		}
		if (I('text')) {
			$this->text = I('text');
		} else {
			$this->text = '选择图片';
		}
		$this->name = I('name');
		$this->imgnum = I('imgnum');
		$this->display();
	}

	/*上传图片*/
	public function uploadImg() {
		if (!$_POST) {
			$this->error('页面不存在');die;
		}
			$upload = new \Think\Upload();
			$upload->mimes 		= array('image/jpeg','image/png');
			$upload->exts 		= array('jpg','png');
			$upload->maxSize 	= '2097152';
			$upload->hash 		= false;
			$upload->rootPath 	= './Public/upfile/';
			$upload->saveName   = array('date', 'YmdHis-'.rand(1000,9999));
			$status = $upload->upload();

		if ($status) {
			$result = $status['file']['savepath'].$status['file']['savename'];
			$name = I('name');
			$imgnum = I('imgnum');

			/*写入session*/
			if ($name == 'arr') {
				$arrimg = session('arr');
				if ($imgnum != '') {
					$arrimg[$imgnum] = $result;
					$num = $imgnum;
				} else {
					$arrimg[] = $result;
					$num = count($arrimg) - 1;
				}
				session('arr', $arrimg);
			} else if($name) {
				session($name, $result);
			} else {
				session('fmimg', $result);
			}
			/*跳转到结果页面*/
			$this->redirect('result', array('name' => $name, 'imgnum' => $num));
		} else {
			echo $upload->getError();
			echo '<br>';
			$this->redirect('sele', '', 3);
		}
	}

	/*显示结果*/
	public function result() {
		$url1 = session ('item_pho');
		

		$url = session('tutu');

		$name = I('name');
		$imgnum = I('imgnum');
		if ($name == 'arr') {
			$this->name = $name;
			$this->imgnum = $imgnum;
			$this->img =  session($name)[$imgnum];
		} else if ($name) {
			$this->name = $name;
			$this->img =  session($name);
		} else {
			$this->img =  session('fmimg');
		}
		$this->display();
	}




}