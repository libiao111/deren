ThinkPHP 3.2.3

1.CSS、JS、IMG、QITA文件：
    样式表JS、JQ路径：./Public/

2.页面文件：
    1) 前端页面文件路径：./App/Home/View/Index/
    2) 引用CSS、JS等文件方式：
        <img src="__QITA__/index.png" alt="" />
        <img src="__IMG__/index.png" alt="" />
        <link href="__CSS__/index.css" />
        <script src="__JQ__/index.js"></script>
    3) 页面访问路径：http://localhost/根目录/index.php/home/index/页面名称
    4) 根目录：index.php 所在文件夹



3.html页面命名统一小写

4.html页面title写明页面名称：如《首页》《首页详情》《展示列表》《展示详情》等

5.html页面文件内不能写内联样式：
    1) 错误写法：<a href="" style="width:100px;">错误</a> 不能写style内联样式
