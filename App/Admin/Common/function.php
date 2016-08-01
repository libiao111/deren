<?php
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

// [0] => Array(
//     [key] => load
//     [name] => 4.png
//     [type] => image/png
//     [size] => 494699
//     [ext] => png
//     [savename] => 5799a755f3ada.png
//     [savepath] => 
// )
/**
* 多图片上传
*/
function loadImageHandler()
{
    $config = array(
        'rootPath'      =>  C('UPLOAD_PATH'),                   //保存根路径
        // 'savePath'      =>  'upfile/',                       //保存路径
        // 'saveName'      =>  array('date', 'YmdHis-'.rand(1000,9999)),
        'maxSize'       =>  0,                            //上传的文件大小限制 (0-不做限制)
        'mimes'         =>  array('image/jpeg','image/png'),    //允许上传的文件MiMe类型
        'exts'          =>  array('jpg','png'),                 //允许上传的文件后缀
        'autoSub'       =>  false,                              //自动子目录保存文件
        'hash'          =>  false                               //是否生成hash编码
    );
    $load = new \Think\Upload($config);
    $result = $load->upload();
    foreach ($result as $k => $img) {
        $result[$k] = $img['savename'];
    }
    return $result;
}

/**
* 单图片上传
*/
function loadOneImageHandler($file)
{
    $config = array(
        'rootPath'      =>  C('UPLOAD_PATH'),                   //保存根路径
        // 'savePath'      =>  'upfile/',                       //保存路径
        // 'saveName'      =>  array('date', 'YmdHis-'.rand(1000,9999)),
        'maxSize'       =>  0,                            //上传的文件大小限制 (0-不做限制)
        'mimes'         =>  array('image/jpeg','image/png'),    //允许上传的文件MiMe类型
        'exts'          =>  array('jpg','png'),                 //允许上传的文件后缀
        'autoSub'       =>  false,                              //自动子目录保存文件
        'hash'          =>  false                               //是否生成hash编码
    );
    $load = new \Think\Upload($config);
    $img = $load->uploadOne($file);
    return $img['savename'];
}

/**
* 上传zip
*/
function loadPackageHandler($file)
{
    $config = array(
        'rootPath'      =>  C('UPLOAD_PATH'),           //保存根路径
        'savePath'      =>  'zip/',                     //保存路径
        'maxSize'       =>  0,                    //上传的文件大小限制 (0-不做限制)
        'mimes'         =>  array('application/zip'),   //允许上传的文件MiMe类型
        'exts'          =>  array('zip'),               //允许上传的文件后缀
        'autoSub'       =>  false,                      //自动子目录保存文件
        'hash'          =>  false                       //是否生成hash编码
    );
    $load = new \Think\Upload($config);
    $zip = $load->uploadOne($file);
    return 'zip/'.$zip['savename'];
}


/**
* 裁剪图片
* $img      图片名
* $width    宽度
* $height   高度
*/
function image_cut($img, $width, $height = null)
{
    if (!$height) {
        $height = $width;
    }
    $imgurl = C('UPLOAD_PATH').$img;
    $imgs = new \Think\Image();
    // 获取需要处理的图片
    $imgs->open($imgurl);
    // 生成缩略图 宽,高,类型6种：3剧中
    $imgs->thumb($width,$height,3);
    // 保存路径+名称
    $suffix = explode('.', $img)[1];
    $imgs->save($imgurl, $suffix);
}



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

