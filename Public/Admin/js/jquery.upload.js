 /* 储存当前点击对象 */
var uploadReturnObj = null;

/* 加载form表单 */
function loadFormWrapper()
{
	if ('undefined' == typeof uploadActionUrl) {
		alert('未设置上传路径变量: var uploadActionUrl')
		return false;
	};
	var obj = ''+
	'<form name="jqueryupload" class="hide" action="" target="uploadhander" method="post" enctype="multipart/form-data">'+
        '<input type="hidden" name="w">'+
        '<input type="hidden" name="h">'+
        '<input type="file" name="file">'+
    '</form>'+
    '<iframe name="uploadhander" class="hide" frameborder="0"></iframe>';
    $('body').append(obj);
}
/* 调用上传 */
function uploadStart(obj)
{
	uploadReturnObj = obj;
	var form = $('form[name="jqueryupload"]');
	if (!form.length) {
		loadFormWrapper();
		form = $('form[name="jqueryupload"]');
		form.find('input[name="file"]').change(function () {
	    	form.submit();
	    });
	};

	var type = $(obj).attr('data-type')/1;
	if(type) {
		form.attr('action', uploadActionSilder);
	} else {
		form.attr('action', uploadActionUrl);
	}

	var w = $(obj).attr('data-w');
	if (w) {
		form.find('input[name="w"]').val(w);
	};
	var h = $(obj).attr('data-h');
	if (h) {
		form.find('input[name="h"]').val(h);
	};
    form.find('input[name="file"]').click();
}

/* 反馈结果 */
function uploadReturn(status, area, data)
{
	$('form[name="jqueryupload"]').remove();
	$('iframe[name="uploadhander"]').remove();
	if (status) {
		var obj = $(uploadReturnObj).parent();
		var clone = obj.clone();
		$(uploadReturnObj).parent().css('background-image', 'url('+area+data+')');
		$(uploadReturnObj).siblings('input').val(data);
		obj.after(clone);
		obj.css('background-image', 'url('+data+')');
	} else {
		alert(data);
	};
}
