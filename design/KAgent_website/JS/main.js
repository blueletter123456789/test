$(function(){


// クリック機能

  var flg = 1;

  $('.menu').on('click', function(){

    if(flg==1){

      $('.top, .ci, .about, .work, .access, .contact').foggy({
      opacity:      0.8,
      blurRadius:   10,
      quality:      16,
      cssFilterSupport: true
      });

      $('header > .title > .menu').css('color', '#bbbbbb');

      $('header').css('background-color', 'rgba(255, 255, 255, 0)');

      flg = 0;

    }else{

      $('.top, .ci, .about, .work, .access, .contact').foggy(false); 
      
      $('header > .title > .menu').css('color', '#333333');

      $('header').css('background-color', 'rgba(255, 255, 255, 0.7)');
  
      flg = 1;

    }

    $('nav').toggleClass('open');

  });


  $('.content_ses').on('click', function(){

    $('.content_ses > span').toggleClass('open');

  });

  $('.content_dev').on('click', function(){

    $('.content_dev > span').toggleClass('open');

  });


  // ホバー機能

  $('header > .title > .menu').hover(
    function(){
        //マウスカーソルが重なった時の処理
        $('header > .title > .menu').css("text-shadow", "0 0 1rem #cccccc, 0 0 6ch #cccccc, 0 0 1ch #cccccc, 0 0 1rem #cccccc");
    },
    function(){
        //マウスカーソルが離れた時の処理
        $('header > .title > .menu').css("text-shadow", "none");
    }
  );


  // スリック機能

  $('.top_image').slick({
  	dots: true,
  	infinite: true,
  	speed: 800,
  	fade: true,
  	cssEase: 'ease',
    autoplay: true, //自動再生
    autoplaySpeed: 2000,
  });


  // スクロール機能

  $('.text_ci > .content_ci, .text_ci > div > .emphasis_ci, .main_ci > .wrapper_ci').css("opacity","0");

  $(window).scroll(function (){

    $('.text_ci > .content_ci, .text_ci > div > .emphasis_ci, #wrapper_ci1, #wrapper_ci2, #wrapper_ci3').each(function(){

      var contentPos = $('.text_ci > .content_ci').offset().top;   

      var emphasisPos = $('.text_ci > div > .emphasis_ci').offset().top;   

      var wrapper1Pos = $('#wrapper_ci1').offset().top;   

      var wrapper2Pos = $('#wrapper_ci2').offset().top;   

      var wrapper3Pos = $('#wrapper_ci3').offset().top;   

      // var imgPos = $(this).offset().top;   

      var scroll = $(window).scrollTop();

      var windowHeight = $(window).height();

      // if (scroll > imgPos - windowHeight + 100){

      //   $('.text_ci > .content_ci, .text_ci > div > .emphasis_ci, .main_ci > .wrapper_ci').css({
      //     "opacity": "1", 
      //   });

      // }else{

      //   $('.text_ci > .content_ci, .text_ci > div > .emphasis_ci, .main_ci > .wrapper_ci').css("opacity","0" );
      // }

      if (scroll > contentPos - windowHeight + 200){
        $('.text_ci > .content_ci').css("opacity", "1");
      }else{
        $('.text_ci > .content_ci').css("opacity","0");
      }

      if(scroll > emphasisPos - windowHeight / 2){
        $('.text_ci > div > .emphasis_ci').css("opacity", "1");
      }else{
        $('.text_ci > div > .emphasis_ci').css("opacity","0");
      }

      if(scroll > wrapper1Pos - windowHeight / 3){
        $('#wrapper_ci1').css("opacity", "1");
      }else{
        $('#wrapper_ci1').css("opacity","0");
      }

      if(scroll > wrapper2Pos - windowHeight / 3){
        $('#wrapper_ci2').css("opacity", "1");
      }else{
        $('#wrapper_ci2').css("opacity","0");
      }

      if(scroll > wrapper3Pos - windowHeight / 3){
        $('#wrapper_ci3').css("opacity", "1");
      }else{
        $('#wrapper_ci3').css("opacity","0");
      }

    });

  });

})
