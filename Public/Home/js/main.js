$(document).ready(function(){

	/* 课程详情标签页的切换 */
	(function(){
		$(".tab_nav_item").click(function(){
			var name = $(this).attr("name");
			if ($(this).hasClass("tab_nav_item_on")){
				return;
			}else{
				$(this).addClass("tab_nav_item_on")
				.siblings(".tab_nav_item").removeClass("tab_nav_item_on");
				$(".tab_content").each(function(){
					var role = $(this).attr("role");
					if(role == name){
						$(this).show();
					}else{
						$(this).hide();
					}
				});
			}			
		});
	})();

	/* 未购买课程时，点击课表弹出购买提示 */
	(function(){
		$(".timetable .a-mask").click(function(e){
			e.preventDefault();
			$("#dialog1").fadeIn();
		});
		// 确认

		// 取消
		$("#dialog1 .default").click(function(){
			$("#dialog1").fadeOut();
		})
	})();

}); // ready end