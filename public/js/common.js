$(function(){
  $('a[href^="#"]').click(function() {
    var speed = 400;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top -82;
    $('body,html').animate({scrollTop:position}, speed, 'swing');
    return false;
  });
});