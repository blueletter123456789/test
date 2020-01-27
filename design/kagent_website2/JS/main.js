$(function(){

	var flg = 1;

	var menu_button = '.menu_button';


	// クリック
	$(menu_button).on('click', function(){

		if (flg == 1){

			$('nav').addClass('open_menu');

			$(menu_button).css("color", "#ffffe0");

			$('section').css("filter", "blur(10px)");

			flg = 0;

		}else{

			$('nav').removeClass();

			$(menu_button).css("color", "#000");

			$('section').css("filter", "blur()");

			flg = 1;
		}

	});


	// スライダー
	$('.slider').slick({
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear', 
		autoplay: true
	});


	// パララックス
	// init controller
	var controller = new ScrollMagic.Controller();

	var wipeAnimation = new TimelineMax()
		.fromTo("section.panel.business", 1, {x: "-100%"}, {x: "0%", ease: Linear.easeNone})  // in from left
		.fromTo("section.panel.about",    1, {x:  "100%"}, {x: "0%", ease: Linear.easeNone})  // in from right
		.fromTo("section.panel.access", 1, {y: "100%"}, {y: "0%", ease: Linear.easeNone}) // in from top
		.fromTo("section.panel.contact", 1, {y: "-100%"}, {y: "0%", ease: Linear.easeNone}); // in from top

	new ScrollMagic.Scene({
				triggerElement: ".homeContainer",
				triggerHook: "onLeave",
				duration: "300%"
			})
			.setPin(".homeContainer")
			.setTween(wipeAnimation)
			.addIndicators() // add indicators (requires plugin)
			.addTo(controller);

})