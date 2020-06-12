$(function () {

	$('.img-wrapper').slick({
	  dots: true, 
	  centerMode: true, 
	  infinite: true,
	  speed: 500,
	  fade: true,
	  cssEase: 'linear'
	});

  // モバイル対応
  const mobMenu = '#menu-wrapper span, #menu-wrapper span::before, #menu-wrapper span::after';
  $(mobMenu).on('click', function(){
    $('#mobile-navigation').toggleClass("hidden");
    if ($('#mobile-navigation').hasClass('hidden')) {
      $("body").css({overflow: "visible"});
    }else{
      $("body").css({overflow: "hidden"});
    }
  })

});