/* 储存当前点击对象 */
var uploadReturnObj = null;

/* 加载form表单 */
function loadFormWrapper()
{	
	var obj = ''+
	'<form name="jqueryupload" class="hide" action="'+uploadActionUrl+'" target="uploadhander" method="post" enctype="multipart/form-data">'+
        '<input type="hidden" name="num">'+
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
	var num = $(obj).attr('data-num')/1;
	if (num >= 0) {
		form.find('input[name="num"]').val(num);
	};
	form.find('input[name="file"]').click();
}

/* 反馈结果 */
function uploadReturn(status, data)
{	
	$('form[name="jqueryupload"]').remove();
	$('iframe[name="uploadhander"]').remove();
	if (status) {
		var obj = $(uploadReturnObj).parent();
		var clone = obj.clone();
		obj.css('background-image', 'url('+data+')');
		obj.after(clone);
	} else {
		alert(data);
	};
}