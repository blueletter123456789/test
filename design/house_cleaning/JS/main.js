$(function(){
var _window = $(window),
    _header = $('.site_header'),
    logoBottom = $('.header_logo').height(),
    heroBottom;

_window.on('scroll',function(){
    heroBottom = $('.top').height();
    heroBottom += logoBottom;
    if(_window.scrollTop() > heroBottom){
        _header.addClass('fixed');   
    }
    else{
        _header.removeClass('fixed');   
    }
});
 
_window.trigger('scroll');

});