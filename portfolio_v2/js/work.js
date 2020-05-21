$(function () {
  var controller = new ScrollMagic.Controller();

  var windowH = $(window).height();

  var scene1 = new ScrollMagic.Scene({
    triggerElement: "#panel1",
    triggerHook: "onLeave",
  })
    .setPin(".p1")
    .addTo(controller);

  var scene2 = new ScrollMagic.Scene({
    triggerElement: "#panel2",
    triggerHook: "onLeave",
  })
    .setClassToggle("#panel1", "hidden")
    .setPin(".p2")
    .addTo(controller);

  var scene3 = new ScrollMagic.Scene({
    triggerElement: "#panel3",
    triggerHook: "onLeave",
  })
    .setPin(".p3")
    .setClassToggle("#panel2", "hidden")
    .addTo(controller);

  var scene4 = new ScrollMagic.Scene({
    triggerElement: "#all-works",
    triggerHook: "onEnter",
  })
    .setClassToggle("#panel3", "hidden")
    .addTo(controller);
});
