$(function() {

	$('#about').click(function(){
	var speed = 1000;　//スムーズスクロールスピード
	var href= $(this).attr("href");
	var target = $(href == "#" || href == "" ? 'html' : href);
	var position = target.offset().top;
	$("html, body").animate({scrollTop:position}, speed, "swing");
	return false;
 	});

	var controller = new ScrollMagic.Controller();

});
