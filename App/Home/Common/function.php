<?php
/* ---------------------------------------客户端函数--------------------------------------- */

function home()
{
    echo '客户端';
}


function pullCode($data){
	//载入ucpass类
	require_once('./Public/code/lib/Ucpaas.class.php');
	//初始化必填
	$options['accountsid'] = '24fac055937d72093b14c2f7156211e8';
	$options['token'] 	   = 'e7bde953375c09e7847d0bdd017fea47';
	$appId 			 	   = "ecc4aebb93c848c6960cdd7ef397c50a";
	//初始化 $options必填
	$ucpass = new Ucpaas($options);
	//开发者账号信息查询默认为json或xml
	//$ucpass->getDevinfo('xml');
	$code = $data['code'];
	$to = $data['user_mobi'];
	$templateId = "1623";
	$param="您的,$code,3";
	$result = $ucpass->templateSMS($appId,$to,$templateId,$param);
	
	return $result;
}