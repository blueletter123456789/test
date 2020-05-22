$(function () {

	var fLocate = $('#front').offset().top;
	var eLocate = $('#end').offset().top;

	$('#left-circle').click(function(){
		$("#left-circle").addClass("click");
		$("#front").addClass("hidden");
		setTimeout(function(){
			$(window).scrollTop(fLocate);
			$("#left-circle").removeClass("click");
		},1000);
	});

	$('#right-circle').click(function(){
		$("#right-circle").addClass("click");
		$("#end").addClass("hidden");
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


});