<?php
/* 上传图片 */
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
    $upload->rootPath   = C('UPLOAD_IMG_PATH'); // 上传路径
    $upload->saveExt    = 'png';
    $upload->saveName   = array('date', 'YmdHis-'.rand(1000,9999));
    $status = $upload->upload();
    if ($status) {
        $result = $status['file']['savepath'].$status['file']['savename'];
        if ($width) { /* 执行切图 */
            image_cut($result, $width, $height);
        }
        $data['status'] = true;
        $data['data'] = $result;
    } else {
        $data['status'] = false;
        $data['data'] = $upload->getError();
    }
    return $data;
}

/*缩略切图*/
function image_cut($img, $width, $height = null)
{
    if (!$height) {
        $height = $width;
    }
    $imgurl = C('UPLOAD_IMG_PATH').$img;
    $imgs = new \Think\Image();
    // 获取需要处理的图片
    $imgs->open($imgurl);
    // 生成缩略图 宽,高,类型6种：3剧中
    $imgs->thumb($width,$height,3);
    // 保存路径+名称
    $suffix = explode('.', $img)[1];
    $imgs->save($imgurl, $suffix);
}





    





