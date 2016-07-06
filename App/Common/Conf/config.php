<?php
return array(
    'TMPL_TEMPLATE_SUFFIX'  => '.html',                 // 模版文件后缀名
    'URL_HTML_SUFFIX'       => 'ogv',                   // 设置文件后缀方式
    'URL_MODEL'             => 1,                       // 设置URL显示方式
    'TMPL_VAR_IDENTIFY'     => 'array',                 // 点语法默认解析
    // 'DEFAULT_FILTER'        => 'htmlspecialchars',      // 设置表单文本提交过滤方式
    // 'DEFAULT_MODULE'        => 'Admin',                 // 默认模块
    // 'MODULE_ALLOW_LIST'     => array('Home'),           // 访问模板设置
    // 'TMPL_ACTION_ERROR'     => './Public/error.html',   // 默认错误跳转对应的模板文件
    'LOAD_EXT_FILE' =>  'passfunction',                 // 配置函数文件名

    'TMPL_PARSE_STRING' => array(                       // public模板路径
        '__QITA__' => __ROOT__.'/Public/qita',
        '__CSS__'  => __ROOT__.'/Public/home/css',
        '__IMG__'  => __ROOT__.'/Public/home/img',
        '__UPFILE__'  => __ROOT__.'/Public/upfile',
        '__JS__'   => __ROOT__.'/Public/home/js'
    ),

    'DB_TYPE' => 'mysql',
    //'DB_PREFIX' => 'sys_',
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PWD'  => '',
    'DB_NAME' => 'deren',

    'RBAC_SUPERADMIN' => 'admin',               // 超级管理员名称
    'ADMIN_AUTH_KEY'  => 'superadmin',          // 超级管理员识别
    'USER_AUTH_ON'    => true,                  // 是否开启验证
    'USER_AUTH_TYPE'  => 1,                     // 验证类型（1：登录验证 2：实时验证）
    'USER_AUTH_KEY'   => 'uid',                 // 用户认证识别号
    'NOT_AUTH_MODULE' => 'Open',                // 无需认证的控制器
    'NOT_AUTH_ACTION' => '',                    // 无需认证的操作方法
    'RBAC_ROLE_TABLE' => 'sys_role',            // 角色表
    'RBAC_USER_TABLE' => 'sys_role_user',       // 角色与用户关联表
    'RBAC_ACCESS_TABLE' => 'sys_rbac_access',   // 权限表
    'RBAC_NODE_TABLE' => 'sys_rbac_node'        // 节点表
);