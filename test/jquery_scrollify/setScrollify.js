$(function(){
	var current;

	$.scrollify({
		section:"section",
		setHeights:false,
		scrollbars:false,
			before:function(i,section){
				current = i;
			},
		});
		
	$(window).on('resize',function(){
		if(current){
			var currentScrl = $('section').eq(current).offset().top;
			$(window).scrollTop(currentScrl);
		}
	});
})