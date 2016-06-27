<?php
/* ---------------------------------------Common公用函数--------------------------------------- */

/*打印方法*/
function p($array) {
	dump($array, 1, '', 0);
}
/*rbac节点递归重组*/ 
function node_merge($node,$access = null, $pid = 0){
    $arr = array();
    foreach($node as $v){
        if(is_array($access)){
            $v['access']= in_array($v['id'],$access) ? 1 : 0;
        }
        if($v['parent_id']==$pid){
            $v['child'] = node_merge($node,$access,$v['id']);
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
function photo_cut($img, $width, $height = null)
{
    if (!$height) {
        $height = $width;
    }
    $imgurl = '../think/resource/'.$img;
    $imgs = new \Think\Image();
    // 获取需要处理的图片
    $imgs->open($imgurl);
    // 生成缩略图 宽,高,类型6种：3剧中
    $imgs->thumb($width,$height,3);
    // 保存路径+名称
    $imgs->save($imgurl,'png');
    return $img;
}


/* 上传图片 */
function uploadHandle($file, $width, $height = null)
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
    $upload->rootPath   = '../think/resource/';
    $upload->saveExt    = 'png';
    $upload->saveName   = array('date', 'YmdHis-'.rand(1000,9999));
    $status = $upload->upload($file);
    if ($status) {
        $result = $status['file']['savepath'].$status['file']['savename'];
        if ($width) {
            $result = photo_cut($result, $width, $height);
        }
    } else {
        $result = $upload->getError();
    }
    return $result;

}
