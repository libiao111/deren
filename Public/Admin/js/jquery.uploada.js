/* 储存当前点击对象 */
var uploadReturnObja = null;

/* 加载form表单 */
function loadFormWrappera()
{	
	var obj = ''+
	'<form name="jqueryuploads" class="hide" action="'+uploadActionUrls+'" target="uploadhanders" method="post" enctype="multipart/form-data">'+
        '<input type="hidden" name="nums">'+
        '<input type="file" name="file">'+
    '</form>'+
    '<iframe name="uploadhanders" class="hide" frameborder="0"></iframe>';
    $('body').append(obj);
}

/* 调用上传 */
function uploadStart(obj)
{	
	
	uploadReturnObja = obj;
	var form = $('form[name="jqueryuploads"]');
	if (!form.length) {
		loadFormWrappera();
		form = $('form[name="jqueryuploads"]');
		form.find('input[name="file"]').change(function () {
			form.submit();
	    });
	};
	var num = $(obj).attr('data-num')/1;
	if (num >= 0) {
		form.find('input[name="nums"]').val(num);
	};
	form.find('input[name="file"]').click();
}

/* 反馈结果 */
function uploadReturna(status, data)
{	
	$('form[name="jqueryuploads"]').remove();
	$('iframe[name="uploadhanders"]').remove();
	if (status) {
		var obj = $(uploadReturnObja).parent();
		var clone = obj.clone();
		obj.css('background-image', 'url('+data+')');
		obj.after(clone);
	} else {
		alert(data);
	};
}
