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
  $('input, textarea').on('blur', function(){
    var name = $(this).attr('name');
    var val = $(this).val();
    console.log(name + ':' + val);

    if (name == 'tel'){
      chkTel(val);
    }
    
  });

  function chkTel(val){
    if (val.match(/^\d{10,11}$/)){
      console.log('OK');
    }else{
      console.log('NG');
    }
  }

















})