$(function () {
  var controller = new ScrollMagic.Controller();

  var windowH = $(window).height();

  var scene1_1 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper1",
    triggerHook: "onLeave", 
    duration: "100%"
  })
    .setClassToggle("#panel1", "active")
    // .addIndicators({name: "p1"})
    .addTo(controller);

  var scene1_2 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper1", 
    triggerHook: "onLeave", 
    duration: "100%"
  })
    .setClassToggle("#circle1", "active")
    // .addIndicators(name, "c1")
    .addTo(controller);

  var scene2_1 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper2",
    triggerHook: "onLeave", 
    duration: "100%"
  })
    .setClassToggle("#panel2", "active")
    // .addIndicators({name: "p2"})
    .addTo(controller);

  var scene2_2 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper2", 
    triggerHook: "onLeave", 
    duration: "100%"
  })
    .setClassToggle("#circle2", "active")
    // .addIndicators(name, "c2")
    .addTo(controller);

  var scene3_1 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper3",
    triggerHook: "onLeave", 
    duration: "200%"
  })
    .setClassToggle("#panel3", "active")
    // .addIndicators({name: "p3"})
    .addTo(controller);

  var scene3_2 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper3", 
    triggerHook: "onLeave", 
    duration: "200%"
  })
    .setClassToggle("#circle3", "active")
    .addIndicators(name, "c3")
    .addTo(controller);

  var scene0 = new ScrollMagic.Scene({
    triggerElement: "#circle-section",
    triggerHook: "onLeave", 
  })
    .setPin("#circle-section")
    // .addIndicators({name: "circle"})
    .addTo(controller);

});
