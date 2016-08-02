/* 提交-课程回调 */
function returnHandler(data)
{
    if (data.status) {
        alert(data.info);
        /* 赋值课程ID */
        var obj = $('.modal');
        obj.find('input[name="course_id"]').val(data.course_id);
    } else {
        alert(data.info);
    };
}

/* 提交-课节回调 */
function returnDotHandler(data)
{
    if (data.status) {
        alert(data.info);
        /* init */
        var obj = $('.modal');
        obj.find('input[name="open_id"]').val('');
        obj.find('input[name="class_name"]').val('');
        obj.find('input[name="class_day"]').val('');
        obj.find('input[name="class_hour"]').val('');
        obj.find('input[name="class_min"]').val('');
        obj.hide();
    } else {
        alert(data.info);
    };
}

$(function () {
    //判断浏览器是否支持FileReader接口  
    if (typeof FileReader == 'undefined') {
        alert('你的浏览器不支持FileReader接口，图片上传预览功能将无法使用!');
        //使选择控件不可操作
        // file.setAttribute("disabled","disabled");
    } else {
        $('input[name="course_photo"],input[name="class_img[]"]').change(function (e) {
            var _this = $(this);
            var file = e.target.files[0] || e.dataTransfer.files[0];
            // var file = document.getElementById("file").files[0];  
            // console.log(file);
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    var url = this.result;
                    _this.parent().css("background-image", "url(" + url + ")");
                }
                reader.readAsDataURL(file);
            }
        });
    }

    /* 提交保存课程 */
    $('.saveall').click(function (e) {
        $('form.editor').submit();
    })


    /* 关闭弹窗 */
    $('.back').click(function () {
        $('.modal').hide()
    });


    /* 显示添加课节 */
    $('.addvideo').click(function () {
        var obj = $('.modal');
        var course_id = obj.find('input[name="course_id"]').val();
        if (course_id === '') {
            alert('请先保存课程');
            return false;
        };
        obj.find('input[name="class_img[]"]').val('');
        obj.find('input[name="open_id"]').val('');
        obj.show();
        $('.video_modal_main_edit').show();
    });
    /* 取消 */
    $('.videocancel').click(function () {
        $('.modal').hide()
    })
    /* 保存 */
    $('.videosave').click(function () {
        $(this).parents('form').submit();
    });


    /* 显示编辑课节 */
    $('.operation .edit').click(function (e) {
        var id = $(this).attr('open_id');
        $.post(pullUrl, {id: id}, function(data){
            if (data.status) {
                var obj = $('.modal');
                var va = data.data;
                obj.find('input[name="class_img[]"]').val('');
                obj.find('input[name="course_id"]').val(va.course_id);
                obj.find('input[name="open_id"]').val(va.open_id);
                obj.find('input[name="class_name"]').val(va.class_name);
                obj.find('input[name="class_day"]').val(va.class_day);
                obj.find('input[name="class_hour"]').val(va.class_hour);
                obj.find('input[name="class_min"]').val(va.class_min);
                obj.show();
                $('.video_modal_main_edit').show();
            };
        })
    });


    // 上传按钮
    $('.dib>span.upload').click(function () {
        $(this).siblings('input').click()
    });
    $('.uploadbtn').click(function () {
        $(this).siblings('input').click()
    });
    $('.dib>span.editupload').click(function () {
        $(this).siblings('input').click()
    });







});