$(function () {

	$('.img-wrapper').slick({
	  dots: true, 
	  centerMode: true, 
	  infinite: true,
	  speed: 500,
	  fade: true,
	  cssEase: 'linear'
	});

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

    // ブログデータ取得処理
  $.ajax({
    type: 'GET',
    url: 'https://riding.co.jp/portfolio/ShuheiAbe/blog/wp-json/wp/v2/posts',
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
          $('#table-wrapper').append('<div class="blogs-content"><div class="blogs"><a class="blog-title" href="'+link+'">' + title + '</a></div></div>');
        }
          console.log(title);
  }).fail(function(json){
          $('.data').append("読み込みませんでした。");
  });


});