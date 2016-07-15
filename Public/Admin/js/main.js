"use strict";

require(["jquery"],function($){
	/* 控制frame页中相关高度及宽度 */
	(function(){
		// 设置body-container高度和宽度
		var screenH = document.documentElement.clientHeight;
		var screenW = document.documentElement.clientWidth;
		var body = document.querySelector(".body_container");
		var side = document.querySelector(".side_menu");
		var sideW = side.offsetWidth;
		body.style.height = screenH - 50 + "px";
		body.style.width = screenW - sideW + "px";
		// 设置side-menu的高度	
		side.style.height = screenH - 50 + "px";
		// 设置iframe的高度
		var frame = document.getElementById('iframe');
		frame.style.height = screenH - 50 + "px";
	})();

	/* 管理员菜单的显示与隐藏 */
	(function(){
		var head = document.querySelector(".admin_head");
		var menu = document.querySelector(".menu_box");	
		// 点一次显示，再点一次隐藏
		head.addEventListener("click",function(){
			var status = head.getAttribute("status");
			if (status == 0){
				menu.style.display = "block";
				head.setAttribute("status",1);
			}else{
				menu.style.display = "none";
				head.setAttribute("status",0);
			}	
		});
		// 鼠标移出菜单时隐藏
		menu.onmouseleave = function(){
			this.style.display = "none";
			head.setAttribute("status",0);
		};
		
	})();

	/* 左侧菜单选中样式 */
	(function(){
		// 一级菜单选中	
		// 只有一级链接才有选中效果，点击二级菜单的一级标题，无选中效果，因为只有链接才能获得“选中权”	
		var ul_first = document.getElementById("first_level");
		var li_first = ul_first.querySelectorAll(".first_level_li");
		for (var i = li_first.length - 1; i >= 0; i--) {
			li_first[i].addEventListener("click",function(){
				var name = this.getAttribute("name");
				if(name != 2){
					// 取消已选中项，设置新选中项
					var curr = ul_first.querySelector(".first_level_on");
					if(curr){
						curr.className = "first_level_li";
						this.className += " " + "first_level_on";
					}else{
						this.className += " " + "first_level_on";
					}				
					// 同时，如果二级菜单存在选中，还要取消二级菜单的选中
					var curr2 = ul_first.querySelector(".second_level_on");
					if(curr2){
						curr2.className = "second_level_li";
					}	
				}						
			});
		};
		// 二级菜单选中
		var li_second = ul_first.querySelectorAll(".second_level_li");
		for (var i = li_second.length - 1; i >= 0; i--) {
			li_second[i].addEventListener("click",function(){
				// 首先，取消一级菜单的选中
				var curr1 = ul_first.querySelector(".first_level_on");
				if(curr1){
					curr1.className = "first_level_li";
				}		
				// 取消二级菜单已选中项，设置新选中项，同时设置该二级菜单的一级标题的选中效果
				var curr = ul_first.querySelector(".second_level_on");
				if(curr){
					curr.className = "second_level_li";
					this.className += " " + "second_level_on";
					this.parentNode.previousElementSibling.className += " " + "first_level_on";
				}else{
					this.className += " " + "second_level_on";
					this.parentNode.previousElementSibling.className += " " + "first_level_on";
				}				
			});
		};
	})();

	/* 二级菜单的展开与收起 */
	$(".first_level_li[type='second_level']").click(function(){
		// 如果存在已展开的项，则收起该项
		var curr = $(this).siblings(".first_level_li[status='1']");
		if(curr){
			curr.attr("status",0).next().slideUp("fast");
			curr.find("i[role='caret']").css({"transform":"rotate(0deg)"});
		};
		// 展开与收起
		if($(this).attr("status") == 0){
			$(this).attr("status",1).next().slideDown("fast");
			$(this).find("i[role='caret']").css({"transform":"rotate(90deg)"});
		}else{
			$(this).attr("status",0).next().slideUp("fast");
			$(this).find("i[role='caret']").css({"transform":"rotate(0deg)"});
		}		
	});

	/* 左侧菜单整体的收起与展开 */
	$(".handler i").click(function(){
		var status = $(this).attr("status"),
            screenW = document.documentElement.clientWidth;
		if(status == 1){
			/* 收窄 */
			// 设置status
			$(this).attr("status","0");
			// 设置宽度
			$(".side_menu").animate({"width":"50px"},"fast");
			$(".body_container").animate({"width":screenW - 50 + "px"},"fast");
			// 隐藏与显示
			$(".handler strong").hide();
			$(".first_level_shrink").fadeIn();
			$(".first_level").css("display","none");
			// 箭头变向
			$(".handler i").css("transform","rotate(180deg)");
			// 清空收起状态下所有选中项
			$("#first_level_shrink").find(".first_level_on").removeClass("first_level_on")
			.end().find(".second_level_on").removeClass("second_level_on");
			// 获取展开状态下的选中项，设置收起状态下对应项的选中效果
			var first = $(".first_level_li"),
			    first_sh = $("#first_level_shrink").find(".first_level_shrink_li"),
			    second = $("#first_level").find(".second_level_li"),
			    second_sh = $("#first_level_shrink").find(".second_level_li");
			for (var i = first.size() - 1; i >= 0; i--) {
				if(first.eq(i).hasClass("first_level_on")){
					first_sh.eq(i).addClass("first_level_on");
				}
			};
			for (var i = second.size() - 1; i >= 0; i--) {
				if(second.eq(i).hasClass("second_level_on")){
					second_sh.eq(i).addClass("second_level_on");
				}
			};
			// 隐藏已展开的菜单
			$(".bounding_box").hide();
		}else{
			/* 展开 */
			// 设置status
			$(this).attr("status","1");
			// 设置宽度
			$(".side_menu").animate({"width":"200px"},"fast");
			$(".body_container").animate({"width":screenW - 200 + "px"},"fast");
			// 隐藏与显示
			$(".handler strong").show();
			$(".first_level_shrink").hide();
			$(".first_level").fadeIn();
			// 箭头变向
			$(".handler i").css("transform","rotate(0deg)");
			// 清空展开状态下所有选中项
			$("#first_level").find(".first_level_on").removeClass("first_level_on")
			.end().find(".second_level_on").removeClass("second_level_on");
			// 获取收起状态下的选中项，设置展开状态下对应项的选中效果
			var first = $(".first_level_li"),
			    first_sh = $("#first_level_shrink").find(".first_level_shrink_li"),
			    second = $("#first_level").find(".second_level_li"),
			    second_sh = $("#first_level_shrink").find(".second_level_li");
			for (var i = first_sh.size() - 1; i >= 0; i--) {
				if(first_sh.eq(i).hasClass("first_level_on")){
					first.eq(i).addClass("first_level_on");
				}
			};
			for (var i = second_sh.size() - 1; i >= 0; i--) {
				if(second_sh.eq(i).hasClass("second_level_on")){
					second.eq(i).addClass("second_level_on");
				}
			};
		}
	});

	/* 收起状态 一级菜单选中样式 */
	$(".first_level_shrink_li[name=1]").click(function(){
		$(this).addClass("first_level_on").siblings().removeClass("first_level_on");
		// 取消二级菜单已选项
		$("#first_level_shrink").find(".second_level_on").removeClass("second_level_on");
	});
	$(".bounding_box h3 a").click(function(){
		$(this).parents(".bounding_box").prev()
		.addClass("first_level_on").siblings().removeClass("first_level_on");
	});

	/* 收起状态 二级菜单选中样式 */
	$("#first_level_shrink").find(".second_level_li").click(function(){
		// 取消一级和二级菜单已选项
		$("#first_level_shrink").find(".second_level_on").removeClass("second_level_on")
		.end().find(".first_level_on").removeClass("first_level_on");
		// 添加一级和二级菜单选中效果
		$(this).addClass("second_level_on").parents(".bounding_box").prev().addClass("first_level_on");
	});

	/* 收起状态下鼠标移入显示提示侧栏 */
	$(".first_level_shrink_li").mouseenter(function(){
		// 提示侧栏在鼠标移出时隐藏
		$(".bounding_box").mouseleave(function(){
			$(this).hide();
		});
		// 隐藏已显示的提示侧栏
		$(".bounding_box").hide();
		// 显示提示侧栏
		var topH = $(this).offset().top;
		$(this).next().css("top",topH + "px").show();
	});

}); // require end
