<?php
return array(
    'TMPL_TEMPLATE_SUFFIX'  => '.html',                 // 模版文件后缀名
    'URL_HTML_SUFFIX'       => '.ogv',                  // 设置文件后缀方式
    'TMPL_VAR_IDENTIFY'     => 'array',                 // 点语法默认解析
    'URL_MODEL'             => 1,                       // 设置URL显示方式
    'MODULE_ALLOW_LIST'     => array('Home','Admin','Pay','Alipay'),           // 访问模板设置
    'TMPL_PARSE_STRING' => array(
        '__UP__'        => __ROOT__.'/Public',
        '__CSS__'       => __ROOT__.'/Public/Home/css',
        '__IMG__'       => __ROOT__.'/Public/Home/img',
        '__JS__'        => __ROOT__.'/Public/Home/js',
        '__ACSS__'      => __ROOT__.'/Public/Admin/css',
        '__AIMG__'      => __ROOT__.'/Public/Admin/img',
        '__AJS__'       => __ROOT__.'/Public/Admin/js',
        '__UPFILE__'    => __ROOT__.'/Public/upfile',
        '__AEDITOR__'   => __ROOT__.'/Public/Admin/editor',
        '__ADATEPICK__' => __ROOT__.'/Public/Admin/datepick'
    ),
    'DB_TYPE'   => 'mysql',
    'DB_PREFIX' => 'dr_',
    'DB_HOST'   => 'localhost',
    'DB_USER'   => 'root',
    'DB_PWD'    => '',
    'DB_NAME'   => 'deren',
    'DB_HOST' => 'qdm100230239.my3w.com',
    'DB_USER' => 'qdm100230239',
    'DB_PWD'  => 'stevewins1023',
    'DB_NAME' => 'qdm100230239_db'
);