var _window = $(window),
    _header = $('.site_header'),
    heroBottom;
 
_window.on('scroll',function(){     
    heroBottom = $('body').height();
    if(_window.scrollTop() > heroBottom){
        _header.addClass('fixed');   
    }
    else{
        _header.removeClass('fixed');   
    }
});
 
_window.trigger('scroll');