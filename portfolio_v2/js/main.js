// ローディングアニメーション
$(window).on('load',function(){

  // ローディングアニメーション制御
  ulrBlog = 'http://localhost/github/portfolio_v2/html/blogs.html';
  urlService = 'http://localhost/github/portfolio_v2/html/service.html';
  urlWork = 'http://localhost/github/portfolio_v2/html/works.html';
  
  urlBefore = document.referrer;
  var hereHost = window.location.hostname;
  // console.log(hereHost);
  // console.log(urlBefore);

  $('#loading-page').css({'position': 'fixed', "overflow": "hidden"});

  $('#loading-bar').addClass('end');

  function loadingAnimation(){
    var loading = function(){
      $('#loading-page').removeClass('active');
      $('.site-header').removeClass('hidden');
      $('.main-panel').removeClass('hidden');
      $(window).scrollTop(0);
    };

    var loadingTitle = function(){
      $('#loading-title').css({
        'color': 'transparent', 
        'font-size': '90px', 
        'opacity': '0'
      });
    }

    var loadingBar = function(){
      $('#loading-bar').css('opacity', '0');
    }
    setTimeout(loadingBar, 1900);
    setTimeout(loadingTitle,6000);
    setTimeout(loading,6000);
  }

  if (urlBefore != ulrBlog && urlBefore != urlWork && urlBefore != urlService) {
    loadingAnimation();      
  }else{
    $('#loading-page').css("transition", "none");
    $('#loading-page').removeClass('active'); 
    $('.site-header').removeClass('hidden');
    $('.main-panel').removeClass('hidden');
  }

});

$(function () {
  var windowHeight = $(window).height();
  var windowWidth = $(window).width();


  // navigator section
  var beforePosition = 0;
  var scrollPosition = 0;
  $(window).on('scroll',function(){
    scrollPosition = $(this).scrollTop();
    if ($('#mobile-navigation').hasClass('hidden')) {
      if (scrollPosition >= beforePosition && scrollPosition != 0) {
        $('.site-header').addClass('hidden');
      } else {
        $('.site-header').removeClass('hidden');
        if(scrollPosition >50){
          $('.site-header').addClass('visible');
        }else{
          $('.site-header').removeClass('visible');
        }
      }
    }
    beforePosition = scrollPosition;
  });

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
  var sceneTitle1 = new ScrollMagic.Scene({
    triggerElement: "#top-title",
    triggerHook: "onCenter",
    offset: 100,
    duration: "50%",
  })
    .setPin("#top-title")
    // .addIndicators({ name: "top-title" })
    .addTo(controller);

  var sceneTitle2 = new ScrollMagic.Scene({
    triggerElement: "#top-title",
    triggerHook: "onCenter",
    duration: "50%",
    // reverse:false
  })
    .setClassToggle("#top-title", "active")
    .on("enter", function(event){
      $("#top-title").addClass('active');
      $('#top-title.active').t({
        repeat: 0
      });
    })
    // .addIndicators({ name: "top-title" })
    .addTo(controller);
/*
  var sceneTitle3 = new ScrollMagic.Scene({
    triggerElement: "#top-title",
    triggerHook: "onLeave",
    duration: "50%"
  })
    .setClassToggle("#top-title", "active")
    // .on("enter", function(event){
    //   $("#top-title").removeClass("active");
    // })
    .addIndicators({ name: "top-hidden" })
    .addTo(controller);
*/
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
    offset: "10%",
  })
    .setClassToggle("#about-position", "active")
    // .addIndicators({ name: "about-active" })
    .addTo(controller);

  // サービスを表示させるための処理
  var sceneService = new ScrollMagic.Scene({
    triggerElement: "#service",
    triggerHook: "onEnter",
    // offset: "10%",
  })
    .setClassToggle("#about", "hidden")
    // .addIndicators({ name: "about-hidden" })
    .addTo(controller);


  var sceneService1 = new ScrollMagic.Scene({
    triggerElement: "#service",
    triggerHook: "onEnter",
    duration: "150%"
  })
    .setClassToggle("#service", "active")
    // .addIndicators({ name: "service-active" })
    .addTo(controller);

// 実績表示処理
  var sceneWork1 = new ScrollMagic.Scene({
    triggerElement: "#works",
    triggerHook: "onEnter",
    offset: 200, 
    duration: "100%"
  })
    .setClassToggle("#works", "active")
    // .addIndicators({ name: "works-active" })
    .addTo(controller);

// 実績非表示処理
  var sceneWork2 = new ScrollMagic.Scene({
    triggerElement: "#works",
    triggerHook: "onLeave",
    offset: 200, 
  })
    .setClassToggle("#works", "hidden")
    // .addIndicators({ name: "works-hidden" })
    .addTo(controller);

// ブログ表示処理
  var sceneBlog1 = new ScrollMagic.Scene({
    triggerElement: "#blog",
    triggerHook: "onCenter", 
    offset: "15%"
  })
    .setClassToggle("#blog", "active")
    // .addIndicators({ name: "blog-active" })
    .addTo(controller);

// ブログ固定
  var sceneBlog2 = new ScrollMagic.Scene({
    triggerElement: "#blog",
    triggerHook: "onLeave", 
  })
    .setPin("#blog")
    // .addIndicators({ name: "blog-set" })
    .addTo(controller);


    // ブログデータ取得処理
  $.ajax({
    type: 'GET',
    url: 'http://localhost/wordpress/wp-json/wp/v2/posts?per_page=3',
    dataType: 'json'
  }).done(function(json){
        var len = json.length;
        for(var i=0; i < len; i++){
          var title = json[i].title.rendered;
          var link = json[i].link;
          var excerpt = json[i].excerpt.rendered;

          var pubDD = new Date(json[i].date);
          yy = pubDD.getFullYear();
          mm = pubDD.getMonth() + 1; 
          dd = pubDD.getDate();
          var pubDate = yy +'/'+ mm +'/'+ dd ;

          let pageNum = i + 1;
          $('.blog' + pageNum  + '> h1').text(title);
          $('.blog' + pageNum  + '> p').text(pubDate);
          $('.blog' + pageNum  + '> a').attr('href', link);
        }
  }).fail(function(json){
          $('.data').append("読み込みませんでした。");
  });

  // フォームタグアニメーション
  $(".input-val").keyup(function(){

    if ($(this).val().length != 0) {
      $(this).parent().addClass("filled");
      console.log('chk add');
    }else{
      $(this).parent().removeClass("filled");
      console.log('chk remove');
    }
  })

  $(".input-val").blur(function(){
    if ($(this).val().length != 0) {
      $(this).parent().addClass("filled");
      console.log('chk add');
    }else{
      $(this).parent().removeClass("filled");
      console.log('chk remove');
    }
  })

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
