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
        3) 页面访问路径：http://localhost/根目录/index.php/home/index/页面名称
        4) 根目录：index.php 所在文件夹



    4.html页面命名统一小写

    5.html页面title写明页面名称：如《首页》《首页详情》《展示列表》《展示详情》等

    6.html页面文件内不能写内联样式：
        1) 错误写法：<a href="" style="width:100px;">错误</a> 不能写style内联样式

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
		1)提交路径:{:U('Login/login')}
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
				user_mobi:value (手机号),
				password:value (密码)
			}
		4)反馈数据：
			{
				status => value 0 手机修改失败，1 手机修改成功， 2 验证码不正确
			}
	7、查询线下课，视频课，音频课 -------------------------------------
		1) 注：$course 为php分配命名。
        2) 页面名称：offline.html video.html voice.html
        3) 反馈数据：
			$couse = array(	
				[0] => array(
		            [id] => value (课程id),
		            [type] => value (1,2,3),
		            [course_name] => value (课程名),
		            [course_photo] => value (课程缩略图),
		            [course_intro] => value (课程简介),
		            [course_price] => value (课程价格),
		            [teach_name] => value (老师名),
		            [teach_mobi] => value (老师手机),
		            [teach_add] => value (老师地址),
		            [teach_intro] => value (老师简介),
		            [classtime] => value (课时总长),
		            [offline] => value (线下课图片路径),
		            [addtime] =>value (添加时间)
		            [video_url] => value (音视频路径),
		            [class_num] => value (总课节),
		        ),
				.....
			);
		4)显示方式：
		<foreach name="course" item="v">
			# code...
		</foreach>
		
	8、线下课，视频课，音频课详情---------------------------------------------------------------->
		1)注：$course 为php分配命名。
        2)页面名称：offlinedetails.html, videodetails.html, voicedetails.html
        3)反馈数据：
			$couse array{	
				[0] => array(
		            [id] => value (课程id),
		            [type] =>value (分类名),
		            [course_name] => value (课程名),
		            [course_photo] => value (课程缩略图),
		            [course_intro] => value (课程简介),
		            [course_price] => value (课程价格),
		            [teach_name] => value (老师名),
		            [teach_mobi] => value (老师手机),
		            [teach_add] => value (老师地址),
		            [teach_intro] => value (老师简介),
		            [classtime] => value (课时总长),
		            [offline] => value (线下课图片路径),
		            [video_url] => value (音视频路径),
		            [class_num] => value (总课节),
		            [addtime] => value (添加时间)
		            [class] => array(
		                    [0] => array(
	                            [id] => 1
	                            [class_name] => value (课时名),
	                            [class_time] => value (上课时间),
	                            [class_add] => vlaue (课时地址),
	                            [course_id] => value (课程id),
	                            [class_mins] => value (课时长),
	                            [paixu] => value (课时排序)
	                        )
							...
	                )
					[bigpho] => Array(
						[0]=>array(
							[id] =>value (图片id)
							[course_id] =>value (课程id)
							[bigpho_url] =>value (图片路径)
						),
						...
	                )
				
		        )
			...
			}
		4)显示方式：
		<foreach name="course" item="va">
			# code...
		</foreach>
	9、订单 ---------------------------------------------------------
		1)提交路径:{:U('Index/ordera')}
		2)提交方式：$.post()
		3)提交数据：
			{	
				ordera_name: value (购买人名),
		        order_mobi: value (购买人手机),
		        course_id: value (课程id),
		        user_id：value (用户名)
			}
		
		4)反馈数据：
			{
				status =>value (1 购买成功 0 购买失败)
			}
