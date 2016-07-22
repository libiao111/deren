<?php
/* ---------------------------------------Common公用函数--------------------------------------- */
/* ---------------------------------------Common公用函数--------------------------------------- */
/* ---------------------------------------Common公用函数--------------------------------------- */

/*打印方法*/
function p($array) {
	dump($array, 1, '', 0);
}

//rbac节点递归重组 
function node_merge($node, $pid = 0){
    $arr = array();
    foreach($node as $v){
        if($v['pid'] == $pid){
            $v['child'] = node_merge($node, $v['id']);
            $arr[]=$v;
        }
    }
    return $arr;
}

/*裁剪字符*/
function substr_cut($str, $start, $len = '', $type = 0)
{
    $k = array('',' ','\t','\r','\n');
    $wk = array('','','','','');
    $str = str_replace($k,$wk,$str);
    if (strlen($str) > $start) {
        $tmpstr = "";
        if ($len == '') {$len = $start; $start = 0; }
        for ($i = 0; $i < $len; $i++)
        {
            if ($start <= $i) {
                if ( ord( substr($str, $i, 1) ) > 0xa0 ) {
                    $tmpstr .= substr($str, $i, 3);
                    $i += 2;
                } else {
                    $tmpstr .= substr($str, $i, 1);
                }
            } else {
                if ( ord( substr($str, $i, 1) ) > 0xa0 ) {$i += 2; }
            }
        }
        if ($type) {
            return $tmpstr;
        } else {
            return $tmpstr.'...';
        }
    } else {
        return $str;
    }
}

/*
* 页码类调用
* $table     表单
* $condition 查询条件
* $tiao 	 默认15条
*/
function pageHandle($table, $condition = null, $tiao = null)
{
    /*分页*/
    if (!$tiao) {
        $tiao = 15;
    }
    $count =  M($table)->where($condition)->count();
    $pages = new \Think\Page($count,$tiao);
    $pages->lastSuffix = false;
    $pages->rollPage = 5;
    $pages->setConfig('prev','<');
    $pages->setConfig('first','<<');
    $pages->setConfig('next','>');
    $pages->setConfig('last','>>');
    $limit = $pages->firstRow.','.$pages->listRows;
    $data = array(
        'limit' => $limit,
        'pages' => array(
            'count' => $count,
            'showt' => $tiao,
            'pages' => $pages->show()
        )
    );
    return $data;
}



/*缩略切图*/
function photo_cut($result, $width, $height = null)
{   
    if (!$height) {
        $height = $width;
    }
    $imgurl = './Public/resource/'.$result;
    $imgs = new \Think\Image();
    // 获取需要处理的图片
    $imgs->open($imgurl);
    // 生成缩略图 宽,高,类型6种：3剧中
    $imgs->thumb($width,$height,3);
    // 保存路径+名称
    $imga = date('Y-m-d').'/'.date('YmdHis').'-'.rand(1000,9999).'.png';
    $img = './Public/resource/'.$imga;
    $imgs->save($img,'png');
    return $imga;
}


/* 上传图片 */
function uploadHandle($width, $height = null)
{
    // $_FILES
    if (!$height) {
        $height = $width;
    }
    $upload = new \Think\Upload();
    $upload->mimes      = array('image/jpeg','image/png','image/gif');//允许上传的文件类型
    $upload->exts       = array('jpg','png','gif');// 设置附件上传类型
    $upload->maxSize    = '2097152';// 设置附件上传大小
    $upload->hash       = false;//是否生成文件的hash编码 默认为true
    $upload->rootPath   = './Public/resource/';// 设置附件上传根目录
    $upload->saveExt    = 'png';// 设置附件上传（子）目录
    $upload->saveName   = array('date', 'YmdHis-'.rand(1000,9999));
    $status = $upload->upload();
    if ($status) {
        $result = $status['file']['savepath'].$status['file']['savename'];
        /*if ($width) {
            $imgurl = './Public/resource/'.$result;
            $imgs = new \Think\Image();
            // 获取需要处理的图片
            $imgs->open($imgurl);
            // 生成缩略图 宽,高,类型6种：3剧中
            $imgs->thumb($width,$height,3);
            // 保存路径+名称
            $img = md5(date('YmdHis').rand(1000,9999));
            $imgs->save($img,'png');
        }*/
    } else {
        $result = $upload->getError();
    }
    return $result;
}
/* 上传视频 */
function uploadvideo()
{
    $upload = new \Think\Upload();
    $upload->mimes      = array('video/rmvb','video/mp4','video/3gp','audio/mp3');//允许上传的文件类型
    $upload->exts       = array('avi','rmvb','rm','asf','divx','mpg','mpeg','mpe','wmv','mp4','mkv','vob','3gp','mp3','wma','wav','ogg');// 设置附件上传类型
    $upload->maxSize    = '2097152000';// 设置附件上传大小
    $upload->hash       = false;//是否生成文件的hash编码 默认为true
    $upload->rootPath   = './Public/video/';// 设置附件上传根目录
    //$upload->saveExt    = 'rmvb';// 设置附件上传（子）目录
    $upload->saveName   = array('date', 'YmdHis-'.rand(100000,999999));
    $status = $upload->upload();
    if ($status) {
        $result = $status['file']['savepath'].$status['file']['savename'];
        
    } else {
        $result = $upload->getError();
    }
    return $result;
}
/* 上传图片 2016-07-20 新增 */
function uploadImgHandler($width, $height = null)
{
    // $_FILES
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
