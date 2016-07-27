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
	'<form name="jqueryupload" class="hide" action="'+uploadActionUrl+'" target="uploadhander" method="post" enctype="multipart/form-data">'+
        '<input type="hidden" name="num">'+
        '<input type="hidden" name="name">'+
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
	var num = $(obj).attr('data-num');
	if (num) {
		form.find('input[name="num"]').val(num);
	};
	var name = $(obj).attr('data-name');
	if (name) {
		form.find('input[name="name"]').val(name);
	};
    form.find('input[name="file"]').click();
}

/* 反馈结果 */
function uploadReturn(status, area, data)
{
	$('form[name="jqueryupload"]').remove();
	$('iframe[name="uploadhander"]').remove();
	if (status) {
		$(uploadReturnObj).parent().css('background-image', 'url('+area+data+')');
		$(uploadReturnObj).siblings('input').val(data);
	} else {
		alert(data);
	};
}