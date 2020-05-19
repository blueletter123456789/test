$(function () {

	var controller = new ScrollMagic.Controller();

	var panels = $(".panel");
	console.log(panels);

	for (var i = 1; i < panels.length; i++) {
		new ScrollMagic.Scene({
				triggerElement: panels[i],
				triggerHook: "onLeave",
				duration: "400%"
		})
		.setPin(panels[i], {pushFollowers: false})
		.addIndicators()
		.addTo(controller);
	}

});