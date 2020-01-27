$(function(){

/* Menu animation */
	$('.open').on('click', function(){
		$('nav').addClass('active');

    $.scrollify.disable();
	});
	$('.close').on('click', function(){
		if ($('nav').hasClass('active')) {
		$('nav').removeClass('active');}

    $.scrollify.enable();
		return false;
	});


/* Slider animation */
  $('.slider').slick({
    prevArrow: '<span class="arrow prev-arrow"><i class="material-icons">arrow_left</i></span>',
    nextArrow: '<span class="arrow next-arrow"><i class="material-icons">arrow_right</i></span>',
    centerMode: true, 
    centerPadding: '0px', 
    slidesToShow: 3, 
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: true,
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: true,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });



// バリデーションチェック
  var errorMessage = {
    'name' : '', 
    'mail' : '', 
    'tel' : '', 
    'subject' : '', 
    'content' : '', 
  };

// 空白チェック
  $('input, textarea').on('blur', function(){
    var name = $(this).attr('name');
    var val = $(this).val();

    if(!emptyCheck(name, val)){
      ouputMessage(name);
      return;
    };

// 電話、メール形式チェック
    if (name == 'tel') {
      telCheck(val);
    }else if(name == 'mail'){
      mailCheck(val);
    }else{
      symbolCheck(name, val);
    }

    ouputMessage(name);

  });


  // 空白チェック関数
  function emptyCheck(name, val){

    errorMessage[name] = (val == '') ? '必須項目です' : '';
    return (val=='') ? false : true;

  };

  // 電話形式チェック関数
  function telCheck(val){

  errorMessage['tel'] = (val.match(/^\d{10,11}$/)) ? '' : '電話の形式が正しくありません';　// 三項演算子

  };


  // 記号チェック関数
  function symbolCheck(name, val){
  errorMessage[name] = (val.match(/[!"#$%&'()\*\+\-\.,\/:;<=>?@\[\\\]^_`{|}~]/g)) ? '入力値が正しくありません' : '';
  };


  // メール形式チェック関数
  function mailCheck(val){
    if (!val.match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9]{1}[A-Za-z0-9_.-]*\.[A-Za-z0-9]{1,}$/)){
      errorMessage['mail'] = 'メールの記載が正しくありません'
    }else{
      errorMessage['mail'] = (val.match(/[_.-]{2,}/g)) ? 'メールの記載が正しくないよ' : '';
    }
  };


  // メッセージ出力関数
  function ouputMessage(name){
    var cnt = 0;
    for(key in errorMessage){
      $('input[name="' + name + '"] ~ span.error-message').text(errorMessage[name]);
      $('textarea[name="' + name + '"] ~ span.error-message').text(errorMessage[name]);
      if(errorMessage[key] != '') cnt++;
    }
      if(cnt > 0){
        $('input[name="submit"]').attr('disabled', true);
      }else{
        $('input[name="submit"]').attr('disabled', false);
      }
  };



// スクローリファイ制御

  var current;

  $.scrollify({
    section:'.wrapper > section', 
    setHeights:false, 
    scrollbars:false, 
    scrollSpeed:1000,
    updateHash:false,
    before:function(i,box){
        current = i;
    }
    
  });


})