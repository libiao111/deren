(function($){
	$.fn.tipGenerator = function(options){
		
		this.controller = {
			content: [''],
			color:'#fff',
			font:'14px',
			backcolor: 'rgba(0,0,0,.5)',
			cursor:'pointer',
			h:'36px'
		}

		var opts = $.extend(this.controller,options);
		// 获取调用元素的坐标
		var position = this.offset();
		// 获取调用元素的宽度和高度
		var width = this.width();
		var height = this.height();
		// 获取窗口宽度
		var winW = $(window).width();

		return this.each(function(){

			var tiptool = $('<span class="tipToolWrap"><div></div></span>');

			$('body').append(tiptool);	
			tiptool.siblings('.tipToolWrap').remove();

			// 插入content
			var max = opts.content.length;
			for (var i = 0; i < max; i++){
				var con = $('<span>'+ opts.content[i] +'</span>');
				$('.tipToolWrap').append(con);
			}
			// 当个数超过1个，添加分割线
			if(max > 1){
				$('.tipToolWrap span').css({					
					'borderRightStyle':'solid',
					'borderRightWidth':'1px',
					'borderRightColor':'rgba(255,255,255,.3)'
				});
			};
			
			// 设置样式			
			$('.tipToolWrap').css({
				'position':'absolute',
				'zIndex':999,
				'borderRadius':'3px',				
				'fontSize':opts.font,
				'backgroundColor':opts.backcolor
			});

			$('.tipToolWrap span').css({
				'display':'inline-block',
				'padding':'0 12px',
				'height':opts.h,
				'lineHeight':opts.h,
				'cursor':opts.cursor,
				'color': opts.color			
			});

			var h = $('.tipToolWrap').height();	

			// 小三角的样式
			$('.tipToolWrap div').css({
				'border':'6px solid transparent',
				'borderLeftColor':opts.backcolor,
				'width':'12px',
				'height':'12px',
				'position':'absolute',
				'right':'-12px',
				'top':h/2 - 6 + 'px',
				'borderRadius':'1px'
			});

			// 设置tiptool坐标
			$('.tipToolWrap').css({
				'top':position.top + height/2 - h/2 +'px',
				'right':winW - position.left + 10 + 'px',
			});

			// 鼠标移出tiptool时删除该组件
			tiptool.mouseleave(function(){
				this.remove();
			});
		
		}); // each()结束
	}
})(jQuery);

