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
/*轮播图*/
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






/* 导入EXCEL */
/*function read($filename, $type, $encode = 'utf-8'){
    include_once('Public/Plugin/excel/PHPExcel.php');
    if ($type === 'xlsx') {
        $objReader = PHPExcel_IOFactory::createReader('Excel2007'); 
    } else if ($type === 'xls'){
        $objReader = PHPExcel_IOFactory::createReader('Excel5'); 
    } else { die;}
    $objReader->setReadDataOnly(true); 
    $objPHPExcel = $objReader->load($filename); 
    $objWorksheet = $objPHPExcel->getActiveSheet(); 
    $highestRow = $objWorksheet->getHighestRow(); 
    $highestColumn = $objWorksheet->getHighestColumn(); 
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
    $excelData = array(); 
    for ($row = 1; $row <= $highestRow; $row++) { 
        for ($col = 0; $col < $highestColumnIndex; $col++) { 
            $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
        } 
    } 
    return $excelData; 
}*/


/* 导出用户表EXCEL */
function dataPush($data,$name='Excel') {
    include_once('./Public/PHPExcel.php');
    error_reporting(E_ALL);
    date_default_timezone_set('Europe/London');
    $objPHPExcel = new PHPExcel();
 
    /* 以下是一些设置 ，什么作者 标题啊之类的 */
    $objPHPExcel->getProperties()->setCreator("客户数据")
        ->setLastModifiedBy("客户数据")
        ->setTitle("数据EXCEL导出")
        ->setSubject("数据EXCEL导出")
        ->setDescription("备份数据")
        ->setKeywords("excel")
        ->setCategory("result file");

    /* 以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改 */
    foreach($data as $k => $v) {
        $num = $k + 1;
        //Excel的第A列，uid是你查出数组的键值，下面以此类推
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$num, $v['id'])
        ->setCellValue('B'.$num, $v['user_photo'])
        ->setCellValue('C'.$num, $v['username'])
        ->setCellValue('D'.$num, $v['sex'])
        ->setCellValue('E'.$num, $v['user_mobi'])
        ->setCellValue('F'.$num, $v['logintime'])
        ->setCellValue('G'.$num, $v['status']);
    }
    $objPHPExcel->getActiveSheet()->setTitle('User');
    $objPHPExcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}
/* 导出订单表EXCEL */
function dataPush2($data,$name='Excel') {
    include_once('./Public/PHPExcel.php');
    error_reporting(E_ALL);
    date_default_timezone_set('Europe/London');
    $objPHPExcel = new PHPExcel();
 
    /* 以下是一些设置 ，什么作者 标题啊之类的 */
    $objPHPExcel->getProperties()->setCreator("客户数据")
        ->setLastModifiedBy("客户数据")
        ->setTitle("数据EXCEL导出")
        ->setSubject("数据EXCEL导出")
        ->setDescription("备份数据")
        ->setKeywords("excel")
        ->setCategory("result file");

    /* 以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改 */
    foreach($data as $k => $v) {
        $num = $k + 1;
        if($v['type']==1){
            $v['type']='线下课';
        }else if($v['type']==2){
            $v['type']='视频课';
        }else if($v['type']==3){
            $v['type']='音频课';
        }
        if($v['status']==0){
            $v['status']='未支付';
        }else if($v['status']==1){
            $v['status']='已支付';
        }else if($v['status']==2){
            $v['status']='已退款';
        }
        //Excel的第A列，uid是你查出数组的键值，下面以此类推
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$num, $v['id'])
        ->setCellValue('B'.$num, $v['type'])
        ->setCellValue('C'.$num, $v['order_time'])
        ->setCellValue('D'.$num, $v['ordera_name'])
        ->setCellValue('E'.$num, $v['ordera_mobi'])
        ->setCellValue('F'.$num, $v['current_price'])
        ->setCellValue('G'.$num, $v['status']);
    }
    $objPHPExcel->getActiveSheet()->setTitle('User');
    $objPHPExcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}


/* 导入数据重组 */
/*function dataHandle($arr) {
    $data = array();
    foreach ($arr as $k => $va) {
        if ($k > 1) {
            $time = intval(($va[0] - 25569) * 3600 * 24);
            $time = explode('-', date('Y-m-d', $time));
            if ($va[18]) {
                $ysyf = $va[18];
            } else {
                $ysyf = 0;
            }
            $data[] = array(
                'year' => $time[0],
                'date' => $time[1].'-'.$time[2],

                'shrxm' => $va[1],
                'shrdh' => $va[2],
                'ch' => $va[3],
                'fhrxm' => $va[4],
                'bh' => $va[5],
                'fhrdh' => $va[6],
                'hm' => $va[7],
                'js' => $va[8],
                'tj' => $va[9],
                'tyf' => $va[10],
                'dfka' => $va[11],
                'dska' => $va[12],
                'zyf' => $va[13],
                'fkfs' => $va[14],
                'bza' => $va[15],
                'qhr' => $va[16],
                'skrq' => $va[17],
                'ysyf' => $ysyf,
                'dfkb' => $va[19],
                'dskb' => $va[20],
                'bzb' => $va[21],
                'zkrq' => $va[22],
                'zkje' => $va[23],
                'fkrq' => $va[24],
                'fkje' => $va[25],
                'add_date' => time()
            );
        }
    }
    return $data;
}
*/
