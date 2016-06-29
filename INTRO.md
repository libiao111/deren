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




二、接口信息

    1、用户注册--------------------------------------------------------------------------
        1) 请求路径：{:U('zhuceHandle')}
        2) 请求方式：$.post()
        3) 提交数据：
            {
                key1: val1
                key2: val2
                key3: val3
                ...
            }
        4) 反馈数据：
            {
                status: 0(失败) 1(成功) ...
            }

    2、用户登录--------------------------------------------------------------------------
        1) 请求路径：{:U('loginHandle')}
        2) 请求方式：$.post()
        3) 提交数据：
            {
                key1: val1
                key2: val2
                key3: val3
                ...
            }
        4) 反馈数据：
            {
                status: 0(失败) 1(成功) ...
            }

    3、需求列表页面--------------------------------------------------------------------------
        1) 注：$list 为php分配命名。
        2) 页面名称：demand.html
        3) 反馈数据：
            $list = array(
                '0' => array(
                    'key1' => val1
                    'key2' => val2
                    'key3' => val3
                    ...
                ),
                '1' => array(
                    'key1' => val1
                    'key2' => val2
                    'key3' => val3
                    ...
                ),
                '3' => array(
                    'key1' => val1
                    'key2' => val2
                    'key3' => val3
                    ...
                ),
                ...
            );
        4) 显示方式：
            <foreach name="list" item="val">
                # code...
            </foreach>


