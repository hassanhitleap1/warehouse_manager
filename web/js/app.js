 $('#ordernow').click(function(){
        $('html, body').animate({scrollTop:$(document).height()}, 'slow');
        return false;
   });
   
   
   $(window).scroll(function () {
    var elem = $('div');
    setTimeout(function() {
        elem.css({"opacity":"0.2","transition":"2s"});
    },4000);            
    elem.css({"opacity":"1","transition":"1s"});    
});


$(window).scroll(function () {
  var Bottom = $(window).height() + $(window).scrollTop() >= $(document).height();
if(Bottom )
{
$('#div').hide();
}
});

$(window).scroll(function() {
  if ($(this).scrollTop() > 0) {
    $('.a').fadeOut();
  } else {
    $('.a').fadeIn();
  }
});
