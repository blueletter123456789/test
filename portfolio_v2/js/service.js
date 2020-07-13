$(function () {

	var fLocate = $('#front').offset().top;
	var eLocate = $('#end').offset().top;
	// console.log(fLocate);
	// console.log(eLocate);

	$('#left-circle').click(function(){
		$("#left-circle").addClass("click");
		$("#front").addClass("hidden");
		setTimeout(function(){
			$(window).scrollTop(fLocate);
			$("#left-circle").removeClass("click");
		},1000);
		setTimeout(function(){
			$("#front").removeClass("hidden");
		},2500);
	});

	$('#right-circle').click(function(){
		$("#right-circle").addClass("click");
		$("#end").addClass("hidden");
		setTimeout(function(){
			$(window).scrollTop(eLocate);
			$("#right-circle").removeClass("click");
		},1000);
		setTimeout(function(){
			$("#end").removeClass("hidden");
		},2500);
	});

	// スマホ対応
	$('#left-circle').bind('touchstart', function() {
		$("#left-circle").addClass("click");
		$("#front").addClass("hidden");
		console.log('chk');
		setTimeout(function(){
			$(window).scrollTop(fLocate);
			$("#left-circle").removeClass("click");
		},1000);
	});

	$('#right-circle').bind('touchstart', function() {
		$("#right-circle").addClass("click");
		$("#end").addClass("hidden");
		console.log('chk');
		setTimeout(function(){
			$(window).scrollTop(eLocate);
			$("#right-circle").removeClass("click");
		},1000);
	});



// スクロールマジック
	var controller = new ScrollMagic.Controller();

	new ScrollMagic.Scene({
			triggerElement: "#left-circle",
			triggerHook: "onCenter",
			duration: "100%"
	})
	.setClassToggle("#left-circle", "active")
	.addTo(controller);

	new ScrollMagic.Scene({
			triggerElement: "#right-circle",
			triggerHook: "onCenter",
			duration: "100%"
	})
	.setClassToggle("#right-circle", "active")
	.addTo(controller);

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