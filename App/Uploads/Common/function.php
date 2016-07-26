<?php
/* 上传图片 2016-07-20 新增 */
function uploadImgHandler($width, $height = null)
{
    if (!$height) {
        $height = $width;
    }
    $upload = new \Think\Upload();
    $upload->mimes      = array('image/jpeg','image/png');
    $upload->exts       = array('jpg','png');
    $upload->maxSize    = '2097152';
    $upload->hash       = false;
    $upload->rootPath   = './Public/resource/'; // 上传路径
    $upload->saveExt    = 'png';
    $upload->saveName   = array('date', 'YmdHis-'.rand(1000,9999));
    $status = $upload->upload();
    if ($status) {
        $result = $status['file']['savepath'].$status['file']['savename'];
        if ($width) {
            photo_cut($result, $width, $height);
        }
        $data['status'] = true;
        $data['data'] = $result;
    } else {
        $data['status'] = false;
        $data['data'] = $upload->getError();
    }
    return $data;
}

?>