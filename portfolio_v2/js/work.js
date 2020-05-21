$(function () {

	var controller = new ScrollMagic.Controller();

	var windowH = $(window).height();

		// define movement of panels
/*		var wipeAnimation = new TimelineMax()
			.fromTo(".panel.p2", 1, {x: "100%"}, {x: "0%", ease: Linear.easeNone})  // in from left
			.fromTo(".panel.p3",    1, {x:  "100%"}, {x: "0%", ease: Linear.easeNone})  // in from right
			.fromTo(".panel.p4", 1, {x: "100%"}, {x: "0%", ease: Linear.easeNone}) // in from top
			.fromTo(".panel.p5", 1, {x: "100%"}, {x: "0%", ease: Linear.easeNone}); // in from top

		// create scene to pin and link animation
		new ScrollMagic.Scene({
				triggerElement: "#top-slider",
				triggerHook: "onLeave",
				duration: "500%"
			})
			.setPin("#top-slider")
			.setTween(wipeAnimation)
			.addTo(controller);*/

	var scene1 = new ScrollMagic.Scene({
			triggerElement: "#panel1", 
			triggerHook: "onLeave"
		})
		.setPin(".p1")
		.addIndicators({name: "scroll-target"})
		.addTo(controller);

	var scene2 = new ScrollMagic.Scene({
			triggerElement: "#panel2", 
			triggerHook: "onLeave"
		})
		.setPin(".p2")
		.addIndicators({name: "scroll-target"})
		.addTo(controller);

	var scene3 = new ScrollMagic.Scene({
			triggerElement: "#panel3", 
			triggerHook: "onLeave", 
		})
		.setPin(".p3")
		.addIndicators({name: "scroll-target"})
		.addTo(controller);

	var scene6 = new ScrollMagic.Scene({
			triggerElement: "#all-works", 
			triggerHook: "onEnter"
		})
		.setClassToggle("#all-works", "active") 
		.addIndicators({name: "scroll-target"})
		.addTo(controller);



});