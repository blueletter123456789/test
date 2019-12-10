$(function(){
	var current;
	var sections_array = [];
	var sections = $('div.wrapper > section');
	// https://webdesignday.jp/inspiration/technique/jquery-js/3812/
	// プロパティ記述参考サイト
	$.scrollify({
		section:"section",
		setHeights:false,
		scrollbars:false,
			before:function(i,section){
				current = i;
			},
			after:function(num,section){
				addActive(num);
			},
		});
		
	$(window).on('resize',function(){
		if(current){
			var currentScrl = $('section').eq(current).offset().top;
			$(window).scrollTop(currentScrl);
		}
	});
	/* SECTION ANIMATION */
	// セクションごとの要素を連想配列に格納
	$(window).on('load resize', function(){
		sections.each(function(){
			var id = $(this).attr('id');
			var top = $(this).offset().top;
			var bottom = top + $(this).outerHeight();
			var sec = {'id':id,'top':top,'bottom':bottom};
			sections_array.push(sec);
		});
		
	});
	// 表示されているセクションにクラスを付与する
	function addActive(num){
		sections.each(function(){
			$(this).removeClass('active');
		});
		var id = sections_array[num].id;
		if(id!=undefined){
			$('#'+id).addClass('active');
		}
	}
})