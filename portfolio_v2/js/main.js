$(function () {
  var windowHeight = $(window).height();
  var windowWidth = $(window).width();
  console.log(windowHeight);
  console.log(windowWidth);

  $("#about").click(function () {
    var speed = 1000; //スムーズスクロールスピード
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "html" : href);
    var position = target.offset().top;
    $("html, body").animate({ scrollTop: position }, speed, "swing");
    return false;
  });

  //  form click event
  $('#form-inside input[type="text"]').on("click", function () {});

  // scroll magic part
  var controller = new ScrollMagic.Controller();

  var sceneTitle = new ScrollMagic.Scene({
    triggerElement: "#top-title",
    triggerHook: "onCenter",
    offset: 100,
    duration: "50%",
  })
    .setPin("#top-title")
    .setClassToggle(".video-wrapper", "hidden")
    .addIndicators({ name: "top-title" })
    .addTo(controller);

  var sceneTop = new ScrollMagic.Scene({
    triggerElement: "#top-title",
    triggerHook: "onLeave",
  })
    .setClassToggle("#top", "active")
    .addIndicators({ name: "top-hidden" })
    .addTo(controller);
});
