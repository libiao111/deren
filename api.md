一、基本信息

    1.PHP框架：thinkPHP 3.2.3

    2.CSS、JS、IMG、QITA文件：
        样式表JS、JQ路径：./Public/

    3.页面文件：
        1) 前端页面文件路径：./App/Home/View/Index/
        2) 引用CSS、JS等文件方式：
            <img src="__QITA__/index.png" alt="" />
            <img src="__IMG__/index.png" alt="" />
            <link href="__CSS__/index.css" />
            <script src="__JQ__/index.js"></script>
        3) 根目录：index.php 所在文件夹
        4) 页面访问路径：http://localhost/根目录/index.php/home/index/页面名称

    4.html页面命名统一小写

    5.html页面title写明页面名称：如 <title>首页</title> 等

    6.html页面文件内不能写内联样式：style=""

<!-- ------------------------------------------------------------------- -->

二、接口信息

	1、用户注册-----------------------------------------------------------------
		1)请求路径：{:U('Login/register')}
		2)提交方式：$.post();
		3)提交数据：
			{	
				password :value (密码),
				code:value(验证码),
				user_mobi:value (手机号)
			};
		4)反馈数据：
			data {
				status： value 0 注册失败，1 注册成功，2 验证码错误
			};

	
	2、 验证手机是否被注册-----------------------------------------------
		1)提交路径：{:U('Login/register1')}
		2)提交方式：$.post();
		3)提交数据：
			{	
				user_mobi：value (手机号)
			}
		
		4)反馈数据：
			data {
				status:value 0 可以注册，1 手机已被注册
			}


	3、 发送短信验证码 ---------------------------------------------------------
		1)提交路径：{:U('Login/sms')}
		2)提交方式：$.post();
		3)提交数据：
			{	
				user_mobi:value (手机号)
			}
		
		4)反馈数据：
			data {
				status:value 0 生成验证码失败，1 生成验证码成功
			}


	4、用户登录 ---------------------------------------------------
		1)提交路径:{:U('Login/loginhandle')}
		2)提交方式：$.post()
		3)提交数据：
			{	
				password:value (密码),
				user_mobi:value (手机号)
			}
		4)、反馈数据：
			{
				status => value 0 手机或密码不正确，1 登录成功
			}


	5、修改密码------------------------------------------------------
		1)提交路径:{:U('Login/xiugai')}
		2)提交方式：$.post()
		3)提交数据：
			{	
				id:value (用户id),
				user_mobi:value (手机号),
				password:value (密码)
			}
		4)反馈数据：
			{
				status => value 0 密码修改失败，1 密码修改成功， 2 验证码不正确
			}


	6、修改手机 ------------------------------------------------------
		1)提交路径:{:U('Login/mobi')}
		2)提交方式：$.post()
		3)提交数据：
			{	
				id:value (用户id),
				user_mobi:value (旧手机号),
				phone:value (新手机号),
			}
		4)反馈数据：
			{
				status => value 0 手机修改失败，1 手机修改成功， 2 验证码不正确
			}


	7、线下课，视频课，音频课列表 -------------------------------------
		1) 注：$course 为php分配命名。
        2) 页面名称：offlinelist.html, videolist.html, audiolist.html
        3) 反馈数据：
			$course = array(	
				[0] => array(
		            [id] => value (课程id),
		            [type] 			=> value (1:线下课, 2:视频课, 3:音频课),
		            [course_name] 	=> value (课程名),
		            [course_photo] 	=> value (课程缩略图),
		            [current_price] => value (课程现价),
		            [course_price] 	=> value (课程原价),
		            [teach_name] 	=> value (老师名),
		            [classtime] 	=> value (课时总长),
		            [offline] 		=> value (线下课图片路径),
		            [addtime] 		=> value (添加时间)
		            [video_url] 	=> value (音视频路径),
		            [class_num] 	=> value (总课节),
		            [status] 		=> value (0:未购买, 1:已购买),
		            [picture] 		=> value (图文简介)
		        ),
				.....
			);
		4)显示方式：
		<foreach name="course" item="v">
			# code...
		</foreach>
		
		
	8、线下课，视频课，音频课详情---------------------------------------------------------------->
		1)注：$course 为php分配命名。
        2)页面名称：offline.html, video.html, audio.html
        3)反馈数据：
			$course = array{	
				[id] => value (课程id),
	            [course_name] => value (课程名),
	            [course_photo] => value (课程缩略图),
	            [current_price] => value (课程现价),
	            [course_price] => value (课程原价),
	            [teach_name] => value (老师名),
	            [classtime] => value (课时总长),
	            [offline_url] => value (线下课图片路径),
	            [video_url] => value (音视频路径),
	            [class_num] => value (总课节),
	            [addtime] => value (添加时间),
	            [status] 		=> value (0:未购买, 1:已购买),
	            [picture] 		=> value (图文简介),
	            [class] => array( //课时
                    [0] => array(
                        [id] => 1
                        [class_name] => value (课时名),
                        [class_time] => value (上课时间),
                        [class_add] => vlaue (课时地址),
                        [course_id] => value (课程id),
                        [class_mins] => value (课时长),
                        [paixu] => value (课时排序)
                    ),
					...
                ),
                [bigpho]=>array( //轮播图
						[0]=>array(
							[id] => value (轮播图id),
							[pho_url] =>value (图片路径),
							[course] =>value (课程id)
							),
						...
					)
				}
			}
		4)显示方式：
		<a>{$v.id}</a>


	9、订单页面-------------------------------------------------------
		1)跳转路径：{:U('Index/order',array('id'=>$id))}
		2)提交数据:
			{
				id:value(课程id)
			}
		3)反馈数据:
			$course = array(	
				[id] => value (课程id),
	            [type] 			=> value (1:线下课, 2:视频课, 3:音频课),
	            [course_name] 	=> value (课程名),
	            [course_photo] 	=> value (课程缩略图),
	            [current_price] => value (课程现价),
		    );
		
		4)显示方式：
			<a>{$v.id}</a> 


	10、提交订单(立即支付) ---------------------------------------------------------
		1)提交路径:{:U('Index/ordera')}
		2)提交方式：form
		3)提交数据：
			{	
				ordera_name: value (购买人名),
		        order_mobi: value (购买人手机),
		    }
	11、1)全部页面反馈数据：
			$login = array(
				1=>已经登录
				0=>未登录
			);
	        $user_content = array(
				username =>value(用户名),
				user_mobi =>value(用户手机),
				sex =>value(0:女，1:男),
				user_photo=>value(头像绝对路径)
	        )

		