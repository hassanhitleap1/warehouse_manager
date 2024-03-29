// ---------Responsive-navbar-active-animation-----------
function test(){
    var tabsNewAnim = $('#navbarSupportedContent');
    var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
    var activeItemNewAnim = tabsNewAnim.find('.active');
    var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
    var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
    var itemPosNewAnimTop = activeItemNewAnim.position();
    var itemPosNewAnimLeft = activeItemNewAnim.position();
    $(".hori-selector").css({
        "top":itemPosNewAnimTop.top + "px",
        "left":itemPosNewAnimLeft.left + "px",
        "height": activeWidthNewAnimHeight + "px",
        "width": activeWidthNewAnimWidth + "px"
    });
    $("#navbarSupportedContent").on("click","li",function(e){
        $('#navbarSupportedContent ul li').removeClass("active");
        $(this).addClass('active');
        var activeWidthNewAnimHeight = $(this).innerHeight();
        var activeWidthNewAnimWidth = $(this).innerWidth();
        var itemPosNewAnimTop = $(this).position();
        var itemPosNewAnimLeft = $(this).position();
        $(".hori-selector").css({
            "top":itemPosNewAnimTop.top + "px",
            "left":itemPosNewAnimLeft.left + "px",
            "height": activeWidthNewAnimHeight + "px",
            "width": activeWidthNewAnimWidth + "px"
        });
    });
}
$(document).ready(function(){
    setTimeout(function(){ test(); });
});
$(window).on('resize', function(){
    setTimeout(function(){ test(); }, 500);
});
$(".navbar-toggler").click(function(){
    $(".navbar-collapse").slideToggle(300);
    setTimeout(function(){ test(); });
});


// --------------add active class-on another-page move----------
jQuery(document).ready(function($){
    // Get current path and find target link
    var path = window.location.pathname.split("/").pop();

    // Account for home page with empty path
    if ( path == '' ) {
        path = 'index.html';
    }

    var target = $('#navbarSupportedContent ul li a[href="'+path+'"]');
    // Add active class to target link
    target.parent().addClass('active');
});


// ------------------------------------------------------------------------------------------------------------






var card = null;

function setCard(_card){
    card=_card;
}

document.body.addEventListener('click', function (e){
    console.log(e.target)
}, true);




document.addEventListener('mousemove', function (e) {
    if(card != null){
        var xAxis = (window.innerWidth / 2 - e.pageX) / 10;
        var yAxis = (window.innerHeight / 2 - e.pageY) / 5;
        card.style.transform = 'rotateY(' + xAxis + 'deg) rotateX(' + yAxis + 'deg)';
    }

});


// function startup() {
//     var el = document.querySelector("body");
//     el.addEventListener("touchstart", handleStart, false);
//     el.addEventListener("touchend", handleEnd, false);
//     el.addEventListener("touchcancel", handleCancel, false);
//     el.addEventListener("touchmove", handleMove, false);
// }
//
// document.addEventListener("DOMContentLoaded", startup);


var el = document.querySelector(".card");





    // }, false);
    el.addEventListener("touchmove", function (e){
        if(card != null){
            var xAxis = (window.innerWidth / 2 - e.pageX) / 10;
            var yAxis = (window.innerHeight / 2 - e.pageY) / 5;
            card.style.transform = 'rotateY(' + xAxis + 'deg) rotateX(' + yAxis + 'deg)';

        }

    }, false);

// ------------------------------------------------------------------------------------------------------------



document.querySelector("body").addEventListener("touchmove", function (e){
    if(card != null){
        var xAxis = (window.innerWidth / 2 - e.pageX) / 10;
        var yAxis = (window.innerHeight / 2 - e.pageY) / 5;
        card.style.transform = 'rotateY(' + xAxis + 'deg) rotateX(' + yAxis + 'deg)';
    }

}, false);






document.body.addEventListener('touchmove', function (e){
    if(card != null){
        var xAxis = (window.innerWidth / 2 - e.pageX) / 10;
        var yAxis = (window.innerHeight / 2 - e.pageY) / 5;
        card.style.transform = 'rotateY(' + xAxis + 'deg) rotateX(' + yAxis + 'deg)';
    }
}, true);



document.body.addEventListener("touchstart", function (e){
    if(card != null){
        var xAxis = (window.innerWidth / 2 - e.pageX) / 10;
        var yAxis = (window.innerHeight / 2 - e.pageY) / 5;
        card.style.transform = 'rotateY(' + xAxis + 'deg) rotateX(' + yAxis + 'deg)';
    }

}, false);
document.body.addEventListener("touchend", function (e){
    if(card != null){
        var xAxis = (window.innerWidth / 2 - e.pageX) / 10;
        var yAxis = (window.innerHeight / 2 - e.pageY) / 5;
        card.style.transform = 'rotateY(' + xAxis + 'deg) rotateX(' + yAxis + 'deg)';
    }

}, false);




    document.body.addEventListener("touchcancel", function (e){
        if(card != null){
            var xAxis = (window.innerWidth / 2 - e.pageX) / 10;
            var yAxis = (window.innerHeight / 2 - e.pageY) / 5;
            card.style.transform = 'rotateY(' + xAxis + 'deg) rotateX(' + yAxis + 'deg)';
        }

    }, false);