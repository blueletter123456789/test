$(function () {
  var windowHeight = $(window).height();
  var windowWidth = $(window).width();
  console.log(windowHeight);
  console.log(windowWidth);

  /*  $("#about").click(function () {
    var speed = 1000; //スムーズスクロールスピード
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "html" : href);
    var position = target.offset().top;
    $("html, body").animate({ scrollTop: position }, speed, "swing");
    return false;
  });


  //  form click event
  $('#form-inside input[type="text"]').on("click", function () {});
*/

  // scroll magic part
  var controller = new ScrollMagic.Controller();

  // ビデオを隠すための処理
  var sceneVideo = new ScrollMagic.Scene({
    triggerElement: "#top",
    triggerHook: "onLeave",
    offset: 100,
    duration: "200%",
  })
    .setClassToggle(".video-wrapper", "hidden")
    // .addIndicators({ name: "video-hidden" })
    .addTo(controller);

  // タイトルを固定するための処理
  var sceneTitle = new ScrollMagic.Scene({
    triggerElement: "#top-title",
    triggerHook: "onCenter",
    offset: 100,
    duration: "50%",
  })
    .setPin("#top-title")
    // .addIndicators({ name: "top-title" })
    .addTo(controller);

  // トップ画面を隠すための処理（背景を白にする）
  var sceneTop = new ScrollMagic.Scene({
    triggerElement: "#top-title",
    triggerHook: "onLeave",
  })
    .setClassToggle("#top", "active")
    // .addIndicators({ name: "top-hidden" })
    .addTo(controller);

  // 概要を表示させるための処理
  var sceneAbout = new ScrollMagic.Scene({
    triggerElement: "#about",
    triggerHook: "onCenter",
    duration: "50%",
  })
    .setClassToggle("#about-position", "active")
    .addIndicators({ name: "about-active" })
    .addTo(controller);

  // サービスを表示させるための処理
  var sceneService = new ScrollMagic.Scene({
    triggerElement: "#service",
    triggerHook: "onEnter",
    // offset: "10%",
  })
    .setClassToggle("#about", "hidden")
    .addIndicators({ name: "about-hidden" })
    .addTo(controller);
});
