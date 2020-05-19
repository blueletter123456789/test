$(function () {

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