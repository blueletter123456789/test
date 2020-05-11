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

  //   フォームクリックイベント
  $('#form-inside input[type="text"]').on("click", function () {
    $("#form-inside span");
  });

  var controller = new ScrollMagic.Controller();
});
