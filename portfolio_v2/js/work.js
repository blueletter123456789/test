$(function () {
  var controller = new ScrollMagic.Controller();

  var windowH = $(window).height();

  // pin the circle
  var scene0_1 = new ScrollMagic.Scene({
    triggerElement: "#title-wrapper",
    triggerHook: "onLeave", 
    offset: windowH, 
  })
    .setClassToggle("#circle-section", "set")
    // .addIndicators({name: "circle"})
    .addTo(controller);


  // pin first circle
  var scene1_1 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper1",
    triggerHook: "onLeave", 
    duration: windowH
  })
    .setClassToggle("#panel1", "active")
    // .addIndicators({name: "p1"})
    .addTo(controller);

  var scene1_2 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper1", 
    triggerHook: "onLeave", 
    duration: windowH
  })
    .setClassToggle("#circle1", "active")
    // .addIndicators(name, "c1")
    .addTo(controller);

  // pin second circle
  var scene2_1 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper2",
    triggerHook: "onLeave", 
    duration: windowH
  })
    .setClassToggle("#panel2", "active")
    // .addIndicators({name: "p2"})
    .addTo(controller);

  var scene2_2 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper2", 
    triggerHook: "onLeave", 
    duration: windowH
  })
    .setClassToggle("#circle2", "active")
    // .addIndicators(name, "c2")
    .addTo(controller);

  // pin third circle
  var scene3_1 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper3",
    triggerHook: "onLeave", 
  })
    .setClassToggle("#panel3", "active")
    // .addIndicators({name: "p3"})
    .addTo(controller);

  var scene3_2 = new ScrollMagic.Scene({
    triggerElement: "#panel-wrapper3", 
    triggerHook: "onLeave", 
  })
    .setClassToggle("#circle3", "active")
    // .addIndicators(name, "c3")
    .addTo(controller);

  var scene4_1 = new ScrollMagic.Scene({
    triggerElement: "#all-works", 
    triggerHook: "onEnter", 
    duration: windowH
  })
    .setPin("#all-works")
    // .addIndicators(name, "c3")
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
