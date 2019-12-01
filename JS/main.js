$(function(){

/* MENU PART */
	$('.open').on('click', function(){
		$('nav').addClass('active');
	});
	$('.close').on('click', function(){
		if ($('nav').hasClass('active')) {
		$('nav').removeClass('active');}
		return false;
	});


/* SLIDER ANIMATION */
  $('.slider').slick({
    centerMode: true,
    prevArrow: '<span class="arrow prev-arrow"><i class="material-icons">arrow_left</i></span>',
    nextArrow: '<span class="arrow next-arrow"><i class="material-icons">arrow_right</i></span>',
    centerPadding: '0px',
    slidesToShow: 3,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: true,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 3
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

// contact validation
  // $('input, textarea').on('blur', function(){
  //   var name = $(this).attr('name');
  //   var val = $(this).val();
  //   console.log(name + ':' + val);

  //   if (name == 'tel'){
  //     chkTel(val);
  //   }
    
  // });

  // function chkTel(val){
  //   if (val.match(/^\d{10,11}$/)){
  //     console.log('OK');
  //   }else{
  //     console.log('NG');
  //   }
  // }

  var errorMessage = {
    'name' : '', 
    'mail' : '', 
    'tel' : '', 
    'subject' : '', 
    'content' : '', 
  };

  $('input, textarea').on('blur', function(){
    var name = $(this).attr('name');
    var val = $(this).val();

    if(!emptyCheck(name, val)){
      ouputMessage(name);
      return;
    };

    if (name == 'tel') {
      telCheck(val);
    }else if(name == 'mail'){
      mailCheck(val);
    }else{
      symbolCheck(name, val);
    }

    console.log(errorMessage);

    ouputMessage(name);



  });

  function emptyCheck(name, val){
    // if (val=='' ) {
    //   errorMessage[name] = '必須項目です';
    // }else{
    //   errorMessage[name] = ''; 
    // }

    errorMessage[name] = (val == '') ? '必須項目です' : '';
    return (val=='') ? false : true;

  };

  function telCheck(val){
    // console.log(val.match(/^\d{10,11}$/));
    // if (val.match(/^\d{10,11}$/)){
    //   errorMessage['tel'] = '';
    // }else{
    //   errorMessage['tel'] = '形式が正しくありません';
    // }

  // 三項演算子
  errorMessage['tel'] = (val.match(/^\d{10,11}$/)) ? '' : '電話の形式が正しくありません';

  };

  function symbolCheck(name, val){
  errorMessage[name] = (val.match(/[!"#$%&'()\*\+\-\.,\/:;<=>?@\[\\\]^_`{|}~]/g)) ? '入力値が正しくありません' : '';
  };

  function mailCheck(val){
    if (!val.match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9]{1}[A-Za-z0-9_.-]*\.[A-Za-z0-9]{1,}$/)){
      errorMessage['mail'] = 'メールの記載が正しくありません'
    }else{
      errorMessage['mail'] = (val.match(/[_.-]{2,}/g)) ? 'メールの記載が正しくないよ' : '';
    }
  };


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







})