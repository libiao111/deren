// 点击删除，滑出提示框
$(".operation .remove").click(function(){
	$(this).siblings(".deleConfirm").stop().animate({"left":0},"100","easeInOutBack");
});
// 取消
$(".deleConfirm span.cancel").click(function(){
	$(this).parent().stop().animate({"left":"100%"},"100","easeInOutBack");
});
// 确认
$(".deleConfirm span.confirm").click(function(){
	var conf = $(this).parent();
	conf.unbind("mouseleave");
	$(this).siblings("p").css("opacity",0).text("Yes sir!")
	.animate({"font-size":"20px","opacity":1},"fast");
	setTimeout(function(){
		conf.animate({"left":"100%"},"100","easeInOutBack",function(){
			$(this).parents("tr").animate({"opacity":0},"800",function(){
				$(this).remove();
			});	
		});	
	},1000);		
});

	