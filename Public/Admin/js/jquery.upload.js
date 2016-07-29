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
        '<input type="file" name="file[]">'+
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
		form.find('input[name="file[]"]').change(function () {
	    	form.submit();
	    });
	};
	var type = $(obj).attr('data-type')/1;
	if(type==1) {
		/*多图*/
		form.attr('action', uploadActionSilder);
	} else if(type==2){
		/*视频*/
	 	form.attr('action', uploadActionVideo);
	} else{
		/*缩略图*/
		form.attr('action', uploadActionUrl);
	}
	/*多图上传*/
	var multiple = $(obj).attr('data-multiple');
	if(multiple=="multiple"){
		form.find('input[name="file[]"]').attr('multiple',multiple);
	}
	var w = $(obj).attr('data-w');
	if (w) {
		form.find('input[name="w"]').val(w);
	};
	var h = $(obj).attr('data-h');
	if (h) {
		form.find('input[name="h"]').val(h);
	};
    form.find('input[name="file[]"]').click();
}

/* 缩略图反馈结果 */
function uploadReturnFming(status, data)
{
	
	$('form[name="jqueryupload"]').remove();
	$('iframe[name="uploadhander"]').remove();
	if (status) {
		$(uploadReturnObj).parent().css('background-image', 'url('+data+')');
	} else {
		alert(data);
	};
}

/*轮播图反馈结果*/
function uploadReturnSlider(status, data)
{	
	var a = data;
	var da = a.split(',');
	$('form[name="jqueryupload"]').remove();
	$('iframe[name="uploadhander"]').remove();
	if (status) {
	 	
	 	var btn = $(uploadReturnObj).parent();
	 	for (var i = 0; i < da.length; i++) {
			var htm = $(uploadReturnObj).clone();
			htm.css({"background-image":'url('+da[i]+')',"background-size":'cover'});
			$('.upload-img').append(htm);
	 		
		};
	} else {
		alert(da)
	}
}
/*视频反馈结果*/
function uploadReturnVideo(status, data)
{
	alert(status);
	alert(data);

	$('form[name="jqueryupload"]').remove();
	$('iframe[name="uploadhander"]').remove();
	var span =$('<span></span>');
	span.text(data);
	$('.upload-video').append(span);
	// if (status) {
 // 	 	$(uploadReturnObj).parent().css('background-image', 'url('+data+')');
 // 	} else {
 //  	alert(data);
 // 	}

}