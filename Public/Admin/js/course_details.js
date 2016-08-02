/* 提交-课程回调 */
function returnHandler(data)
{
    if (data.status) {
        succeeAlt((data.info + '成功 ^_^'));
        /* 赋值课程ID */
        var obj = $('.modal');
        obj.find('input[name="course_id"]').val(data.course_id);
    } else {
        succeeAlt((data.info + '失败 ！'));
    };
}

/* 提交-课节回调 */
function returnDotHandler(data)
{
    if (data.status) {
        succeeAlt((data.info + '成功 ^_^'));
        /* init */
        var obj = $('.modal');
        obj.find('input[name="open_id"]').val('');
        obj.find('input[name="class_name"]').val('');
        obj.find('input[name="class_day"]').val('');
        obj.find('input[name="class_hour"]').val('');
        obj.find('input[name="class_min"]').val('');
        obj.hide();
    } else {
        succeeAlt((data.info + '失败 ！'));
    };
}


/* 成功提示 */
function succeeAlt(txt) {
    $('.hint').show();
    $('.hintmain').show();
    $('.hintmain>p').text(txt);
    setTimeout(function () {
        $('.hint').hide();
    }, 1000);
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

    /* 音频轮播图 */
    $('input[name="class_img[]').change(function () {
        $(this).siblings('input[name="class_image[]"]').val('');
    });

    /* 提交保存课程 */
    $('.saveall').click(function (e) {
//		alert()
		var val=$('.datas'),
			vals=[];
		vals=Array.prototype.slice.call(val);
		console.log(vals)
		console.log(vals.length)
		for(let i=0;i<vals.length;i++){
			if(vals[i].value==''){
				vals[i].focus();
				return false;
			}
		}
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
        obj.find('input[name="class_image[]"]').parent('div').attr('style','');
        obj.find('input[name="class_image[]"]').val('');
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
                var va = data.data;
                var image = va.image;
                var obj = $('.modal');
                obj.find('input[name="class_img[]"]').val('');
                obj.find('input[name="class_image[]"]').parent('div').attr('style','');
                if (image) {
                    for (var i = 0; i < image.length; i++) {
                        obj.find('input[name="class_image[]"]').eq(i).val(image[i].pho_url);
                        obj.find('input[name="class_image[]"]').eq(i).parent('div').css("background-image", "url(" + imageUrl + image[i].pho_url + ")");
                    };
                };
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