<!-- [查询数据类型] -->
1、接口类型 => 数据查询；
2、功能描述 => 页面输出(数据类型)；
3、请求方式 =>无
4、请求参数 => 数组：
 	$dat = array(
	    [0] => array
        (
            [id] => 1
            [data_name] => int
        )
        ...
	);
注: 循环 <foreach name = "dat">
<!-- ------------------------------------------------------------------ -->



<!-- [查询表的应用类型] -->
1、	接口类型 => 数据查询；
2、 功能描述 => 页面输出(应用类型)；
3、 请求方式 =>无
4、 请求参数 => 数组：
 	$apply = array(
		[0] => array
        (
            [id] => 1
            [apply_name] => 通用
        )
        ...
	);
注: 循环 <foreach name = "apply">
<!-- ------------------------------------------------------------------ -->



<!-- 查询表名 关联查询表名,字段表(field)数据类型表(datatype) -->
1、接口类型 => 数据查询；
2、功能描述 => 页面输出(表名,字段,数据类型)；
3、请求方式 =>无
4、请求参数 => 数组：
 	$table =  array(
	    [0] => array
	        (
	            [id] => 1
	            [name_en] => sahg
	            [name_zh] => 割发代首
	            [apply_id] => 1
	            [bb] => array
	                (
	                    [0] => array
	                        (
	                            [id] => 1
	                            [leng] => 20
	                            [default] => 
	                            [null] => 1
	                            [addself] => 0
	                            [majorkey] => 0
	                            [explain] => 热共同
	                            [table_id] => 1
	                            [field_en] => dsaf
	                            [data_id] => 1
	                            [data_name] => int
	                        )
						...
					)
			)
        ...
	);
注: 循环 <foreach name = "table">
<!-- [搜索字段操作] -->
1、接口类型 => 数据查询；
2、功能描述 => 查询表；
3、请求方式 => 方法：form；路径：search
4、请求参数 => 数组：
	array(
        'name'=>value (table表的name)，
        'apply_id'=>value (apply表id),
     );
5、返回参数 => 数组：
 	$table =  array(
	    [0] => array
	        (
	            [id] => 1
	            [name_en] => sahg
	            [name_zh] => 割发代首
	            [apply_id] => 1
	            [bb] => array
	                (
	                    [0] => array
	                        (
	                            [id] => 1
	                            [leng] => 20
	                            [default] => 
	                            [null] => 1
	                            [addself] => 0
	                            [majorkey] => 0
	                            [explain] => 热共同
	                            [table_id] => 1
	                            [field_en] => dsaf
	                            [data_id] => 1
	                            [data_name] => int
	                        )
						...
					)
			)
        ...
	);
注: 循环 <foreach name = "table">


<!-- ------------------------------------------------------------------ -->



<!-- [添加或修改table表记录] -->
1、接口类型 =>数据写入；
2、功能描述 =>创建新数据表；
3、请求方式 =>方法：post；路径：{:U('addtable')}
4、请求参数 =>数组：
	array(	
		id			=>value	(表的id),
		name_zh 	=>value (中文名称),
		name_en 	=>value (英文名称),
	 	apply_id	=>value (应用类型)
	);
	注：有id键 修改操作
		没id键 添加操作

5、返回数据 => 数组，结构如下：
	array(
		status => 1 插入成功 ，0 插入失败 ，2 该表名已存在
	);

<!-- [点击修改获取表的默认显示值] -->
1、接口类型 =>数据查询；
2、功能描述 =>创建新数据表；
3、请求方式 =>方法：ajax；路径：{:U('pulltable')}
4、请求参数 =>数组：
	array(	
		id			=>value	(表的id),
		name_zh 	=>value (中文名称),
		name_en 	=>value (英文名称),
	 	apply_id	=>value (应用类型)
	);
5、返回数据 => 数组，结构如下：
	array(
		status => 1 获取成功 或0 获取失败
	);
<!-- ------------------------------------------------------------------ -->


<!-- 添加或修改时 验证表是否存在 -->

1、接口类型 => 数据查询；
2、功能描述 => 失去焦点时查询字段是否存在；
3、请求方式 =>方法：post；路径：checktable
4、请求参数 => 数组：
	array {
		name 	=>value (英文名称),
		name 	=>value (中文名称)
	}1

5、返回数据 => 数组，结构如下：

	array {
		status => value 1 ，表中字段已存在 或 0， 修改成功
	}


<!-- [添加或修改field字段] -->

1、接口类型 => 数据写入；
2、功能描述 => 给field表添加新数据；
3、请求方式 =>方法：post；路径：{:U('addfield')}
4、请求参数 => 数组：
	array{
		id			=>value	(字段id),
		field_en 	=>value (英文名称),
	 	apply_id	=>value (应用类型),
	 	leng		=>value (长度/值),
	 	default		=>value	(默认值),
	 	addself		=>value (是否自增),
	 	majorkey	=>value (是否有主键),
	 	explain		=>value (说明),
		data_id		=>value (字段类型id),
		null		=>value (是否为空),
		table_id	=>value	(关联表id)
	}
		有id键 修改操作
		没id键 添加操作
5、返回数据 => 数组，结构如下：
	array {
		status => value 1 插入成功 ，0 插入失败 ，2该字段已存在
	}
<!-- [点击修改获取字段的默认显示值] -->
1、接口类型 =>数据查询；
2、功能描述 =>创建新数据表；
3、请求方式 =>方法：ajax；路径：{:U('pullfield')}
4、请求参数 =>数组：
	array(	
		id			=>value	(字段id),
		field_en 	=>value (英文名称),
	 	apply_id	=>value (应用类型),
	 	leng		=>value (长度/值),
	 	default		=>value	(默认值),
	 	addself		=>value (是否自增),
	 	majorkey	=>value (是否有主键),
	 	explain		=>value (说明),
		data_id		=>value (字段类型id),
		null		=>value (是否为空),
		table_id	=>value	(关联表id)
	);
5、返回数据 => 数组，结构如下：
	array(
		status => 1 获取成功 或0 获取失败
	);
<!-- ------------------------------------------------------------------ -->

<!-- [添加或修改时查询field字段知否存在] -->

1、接口类型 => 数据查询；
2、功能描述 => 失去焦点是查询字段是否存在；
3、请求方式 =>方法：post；路径：checkfield
4、请求参数 => 数组：
	array {
		
		field_en 	=>value (英文名称),
	 	table_id 	=>value (表id)
	}

5、返回数据 => 数组，结构如下：
	array {
		status => value 1 表中字段已存在 或 0 修改成功
	}


<!-- ------------------------------------------------------------------ -->

<!-- [删除表操作] -->
1、接口类型 => 数据删除；
2、功能描述 => 删除数据表记录；
3、请求方式 =>方法：post；路径：delete1
4、请求参数 =>数组：
	array{	
		id		=>value	表的id
		
	}
5、返回数据 => 数组，结构如下：
	data{
		status  => value 
	}
	value = 1 删除成功
	value = 0 删除失败


<!-- [删除字段操作] -->
1、接口类型 => 数据删除；
2、功能描述 => 删除字段；
3、请求方式 =>方法：post；路径：delete2
4、请求参数 =>数组：
	array {	
		id		=>value	(字段id)
		
	}
5、返回数据 => 数组，结构如下：
	array {
		status => value 1 删除成功 或 0 删除失败
	}



<!-- ------------------------------------------------------------------ -->

<!-- [生成sql语句操作] -->
1、接口类型 => 数据查询；
2、功能描述 => 查询表；
3、请求方式 =>方法：post；路径：getsql
4、请求参数 =>数组：
	array{	
		id		=>value	(字段id)
	}
5、返回数据 => 数组，结构如下：
	array{
		$result => value 
	}
<!-- ------------------------------------------------------------------ -->



<!-- 注册页面 -->
1、接口类型 => 数据添加；
2、功能描述 => 注册用户；
3、请求方式 =>方法：post；路径：{:U('Login/register')}
4、请求参数 =>数组：
	array{	
		'password' 		=>value (密码),
		'password2'		=>value (重复密码)，
		'user_mobi'		=>value (手机号),
			)
	}
5、返回数据 => 数组，结构如下：
	array{
		$result => value 0 注册失败，1 注册成功，2 手机已被注册，3 两次密码不一致，4验证码错误
	}
<!-- 失去焦点验证手机是否被注册 -->
1、接口类型 => 数据查询；
2、功能描述 => 查询手机；
3、请求方式 =>方法：post；路径：{:U('Login/register1')}
4、请求参数 =>数组：
	array{	
		'user_mobi'		=>value (手机号),
	}
5、返回数据 => 数组，结构如下：
	array{
		$result => value 0 可以注册，1 手机已被注册
	}
<!-- 生成短信验证码 -->
1、接口类型 => 数据获取；
2、功能描述 => 获取短息验证码；
3、请求方式 =>方法：post；路径：{:U('Login/sms')}
4、请求参数 =>数组：
	array{	
		'user_mobi'		=>value (手机号),
	}
5、返回数据 => 数组，结构如下：
	array{
		$result => value 0 生成验证码失败，1 生成验证码成功
	}
<!-- ------------------------------------------------------------------ -->

<!-- 登录页面 -->

1、接口类型 => 数据查询；
2、功能描述 => 登录账号；
3、请求方式 =>方法：post；路径：{:U('Login/login')}
4、请求参数 =>数组：
	array{	
		'password' 		=>value (密码),
		'user_mobi'		=>value (手机号),
			)
	}
5、返回数据 => 数组，结构如下：
	array{
		$result => value 0 手机或密码不正确!，1 登录成功
	}
