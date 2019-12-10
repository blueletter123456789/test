$(function(){
	var current;
	var sections = $('div.wrapper > section');
	// https://webdesignday.jp/inspiration/technique/jquery-js/3812/
	// プロパティ記述参考サイト
	$.scrollify({
		section:"section",
		setHeights:false,
		scrollbars:false,
		scrollSpeed:1000,
			before:function(i,section){
				current = i;
			},
			after:function(num,section){
				sections.each(function(){
					$(this).removeClass('active');
				})
				$(section[num]).addClass('active');
			},
			afterResize:function(){
				if(current){
					var currentScrl = $('section').eq(current).offset().top;
					$(window).scrollTop(currentScrl);
				}
				$('nav').css('display','none');
				setTimeout(function(){
					$('nav').css('display','block');
				}, 1);
			}
		});
		
})