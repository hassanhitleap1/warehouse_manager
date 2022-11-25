jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
                .parent()
                .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
        setCookie('navopen','false',20);
        console.log('navopen', false);
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
        setCookie('navopen','true',20);
        console.log('navopen', true);
    });




});

//open_menu_List();

function open_menu_List(){
    $(".menu-item.active").each(function () {
         $(this).closest(".sidebar-dropdown").addClass("active");
        $(this).closest(".sidebar-submenu").show();

    });
}



$( document ).ready(function() {
   
var x = getCookie('navopen');
console.log("x",x);
if (x) {
    if(x==='true'){
        $(".page-wrapper").addClass("toggled"); 
    }else{
        $(".page-wrapper").removeClass("toggled");
    }
}else{
    $(".page-wrapper").removeClass("toggled");
}

});


function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

