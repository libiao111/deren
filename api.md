<!-- 注册页面 -->
1、提交路径：{:U('Login/register')}
2、接口类型：数据提交；
3、功能描述： 用户注册；
4、数据类型：
	arr {	
		password :value (密码),
		user_mobi:value (手机号),
	};
5、提交方式：
	$.post(url,arr, function(data){
		
	});
6、返回数据格式：
	data {
		status： value 0 注册失败，1 注册成功，2 验证码错误
	};
<!-- 失去焦点验证手机是否被注册 -->
1、提交路径：{:U('Login/register1')}
2、接口类型：数据查询；
3、功能描述：查询手机号是否已经被注册；
4、数据类型：
	arr {	
		user_mobi：value (手机号),
	}
5、提交方式：
	$.post(url,arr, function(data){

	})
6、返回数据格式：
	data {
		status:value 0 可以注册，1 手机已被注册
	}
<!-- 生成短信验证码 -->
1、提交路径：{:U('Login/sms')}
2、接口类型 => 数据提交；
3、功能描述 => 获取短息验证码；
4、数据类型：
	arr {	
		user_mobi:value (手机号),
	}
5、提交方式：
	$.post(url,arr, function(data){
		
	})
6、返回数据格式：
	data {
		status:value 0 生成验证码失败，1 生成验证码成功
	}
<!-- ------------------------------------------------------------------ -->

<!-- 登录页面 -->
1、提交路径:{:U('Login/login')}
2、接口类型 => 数据查询；
3、功能描述 => 用户登录；
4、数据类型：
	arr {	
		password:value (密码),
		user_mobi:value (手机号),
	}
5、提交方式：
	$.post(url,arr, function(data){
		
	})
6、返回数据格式：
	data {
		status => value 0 手机或密码不正确，1 登录成功
	}
<!-- ------------------------------------------------------------------ -->


<!-- 修改密码 -->
1、提交路径:{:U('Login/xiugai')}
2、接口类型 => 数据查询修改；
3、功能描述 => 修改密码；
4、数据类型：
	arr {	
		id:value (用户id),
		user_mobi:value (手机号),
		password:value (密码)
	}
5、提交方式：
	$.post(url,arr, function(data){
		
	})
6、返回数据格式：
	data {
		status => value 0 密码修改失败，1 密码修改成功， 2 验证码不正确
	}

<!-- ------------------------------------------------------------------ -->


<!-- 修改手机 -->

1、提交路径:{:U('Login/mobi')}
2、接口类型 => 数据查询修改；
3、功能描述 => 修改手机；
4、数据类型：
	arr {	
		id:value (用户id),
		user_mobi:value (手机号),
		password:value (密码)
	}
5、提交方式：
	$.post(url,arr, function(data){
		
	})
6、返回数据格式：
	data {
		status => value 0 手机修改失败，1 手机修改成功， 2 验证码不正确
	}
<!-- ---------------------------------------------------------------- -->


<!-- 查询线下课，视频课，音频课 -->
1、提交路径:{:U('Index/offline video voice ')}
2、接口类型 => 数据查询修改；
3、功能描述 => 查询课程列表；
4、数据类型：
	arr {	
		id:value (课程id),
	}
5、提交方式：
	$.post(url,arr, function(data){
		
	})
6、返回数据格式：
	data {
		
	}
注：<foreach name="course">
	
</foreach>
	

<!-- -------------------------------------------------------------- -->

<!-- 课程详情 -->
1、提交路径:{:U('Index/details')}
2、接口类型 => 数据查询；
3、功能描述 => 查询课程详情；
4、数据类型：
	arr {	
		id:value (课程id),
	}
5、提交方式：
	$.post(url,arr, function(data){
		
	})
6、返回数据格式：
	array{
		
	}
注：<foreach name="course">
	
</foreach>
<foreach name="keshi">

</foreach>


<!-- ----------------------------------------------------------------- -->

<!-- 订单 -->
1、提交路径:{:U('Index/ordera')}
2、接口类型 => 数据添加；
3、功能描述 => 添加订单；
4、数据类型：
	arr {	
		ordera_name: value (购买人名),
        order_mobi: value (购买人手机),
        course_id: value (课程id),
        user_id：value (用户名)
	}
5、提交方式：
	$.post(url,arr, function(data){
		
	})
6、返回数据格式：
	array{
		
	}
<!-- ------------------------------------------------------------ -->