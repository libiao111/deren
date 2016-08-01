<?php

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


function getOpenID() {
	if (isset($_GET['code'])) {
		//获取微信服务器回调code;
	    $code = $_GET['code'];
	    $appid = 'wxdf873d378532a1ca'; 
	    $appsecret = 'b79b9814cff2229a9a216b2e64c27f54';

	    $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';	
		$token = json_decode(file_get_contents($token_url));
		$openid = $token->openid;
		$refresh_token = $token->refresh_token;
		
		$refresh_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$refresh_token.'';
		$refresh_token = json_decode(file_get_contents($refresh_token_url));
		$access_token = $refresh_token->access_token;

		$userinfo_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
		$info = json_decode(file_get_contents($userinfo_url));

		$data['openid'] = $info->openid;
		$data['name'] = $info->nickname;
		$data['image'] = $info->headimgurl;
		$data['province'] = $info->province;
		$data['city'] = $info->city;
		$data['country'] = $info->country;	
		$data['sex'] = $info->sex;	
		$data['subscribe_time'] = $info->subscribe_time;
		$subscribe_time = date("Y-m-d H:i", $data['subscribe_time']);
		$data['language'] = $info->language;
		$data['status'] = 1;
		session('openid', $data);
	} else {
	    $data = array('status' => 0);
	}
	return $data;
}