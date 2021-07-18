let SITE_URL = getSiteUrl() ;

function get_price_delivery(){
    let company_delivery_id=$("#company_delivery_id").val();
    let region_id=  $("#region_id").val();
    if(region_id==''){
        alert("ارجو تحديد المحافظة")
        return;
    }
    let url= `${SITE_URL}/index.php?r=regions/get-price&id=${region_id}&company_delivery_id=${company_delivery_id}`;
    $.ajax({
        url: url,
        type: 'GET',
        success: function (json) {
            delivery_price= parseInt(json.data.price_delivery);
            $('#delivery_price').val(delivery_price);
            callculate_all();
        }
    });
}

$(document).on('change','#region_id,#company_delivery_id',function (e) {
     get_price_delivery();
 });








 $(document).on('change','#discount',function (e) {
     callculate_all();
 });

 $(document).on('click','.print_invoice',function (e) {
    let path=$(this).attr("path_url");
    open(path).print()
});


 $(document).on('keyup','#discount',function (e) {
    callculate_all();
});


 $(document).on('keyup','.count_sub_product',function (e) {
    callculate_count_sub_product();
});

function callculate_count_sub_product(){
    let count_sub_product=0;
    $( '.count_sub_product' ).each(function( index, element  ) {
        count_sub_product+= parseInt ($(this ).val());
      });
     console.log(count_sub_product)
     $("#quantity").val(count_sub_product);
    callculate_all();
}

$(document).on('change','#delivery_price',function (e) {
     callculate_all();
});

function callculate_total_price(){
    let amount_required=0;
    let delivery_price=0;
    let discount=0;
    if(!isNaN($("#discount").val()) && $("#discount").val() !=""  ){
        discount=parseFloat($("#discount").val());
    }
     delivery_price= parseFloat( $("#delivery_price").val());
    $(".price_item_count").each(function( index, element  ) {
        amount_required+= parseFloat ($(element ).val());
     });
     amount_required-=discount;
     amount_required+=delivery_price;

     $("#total_price").val(amount_required);

}


function callculate_amount_required(){

    let total_price=0;
    $(".price_item_count").each(function( index, element  ) {
        total_price+= parseFloat ($(element ).val());

    });
    let discount=0;

    if(!isNaN($("#discount").val()) && $("#discount").val() !=""  ){
        discount=parseFloat($("#discount").val());
    }



    $("#amount_required").val(total_price - discount);



}

$(document).on('change','.product_id',function (e) {
    get_product(this);
 });



$(document).on('change','.sub_product_id',function (e) {
    get_sub_product(this);
 });




 $(document).on('change keypress blur keyup','.quantity_sub_product',function (e) {

    let quantity_sub_product =parseInt($(this).val());
    let total_price=0;
     let price= parseFloat($(this).closest(".row").find(".price").val());
    let profit_margin= parseFloat($(this).closest(".row").find(".profit_margin").val());
     $(this).closest(".row").find(".price_item_count").val(price *quantity_sub_product);
    if(quantity_sub_product != '' && quantity_sub_product !='undefined' && ! isNaN(quantity_sub_product )){
        $(this).closest(".row").find(".profits_margin").val( (profit_margin*quantity_sub_product ).toFixed(2) );
        $(this).closest(".row").find(".price_item").val(price * quantity_sub_product);
    }
   callculate_all();



});


 function getSiteUrl() {
    let site_url=window.location.host;
    if (site_url=='localhost:8080'){
        return '';
    }
    return site_url+'/web';
}



$(document).on('click','.remove-item',function (e) {
    callculate_all();
});

$(document).on('change','#area_id',function (e) {
    callculate_all();
});




$(document).on('click', '.fast_order', function(e){
    e.preventDefault();
    url = $(this).attr('href');
    $('#model').modal('show')
        .find('#modelContent')
        .load(url);
});


$(document).on('click', '.modelbutton', function(e){
    e.preventDefault();
    url = $(this).attr('href');
    $('#model').modal('show')
        .find('#modelContent')
        .load(url);
});

$('#model').on('hidden.bs.modal', function () {
    $('#modelContent').html("");
});

$(document).on('click', '.change-status', function(e){
    e.preventDefault();
    var id= $(this).attr("att_id");
    var status_id= $(this).attr("att_status_id");
    var name_status= $(this).attr("name_status");
    let url= `${SITE_URL}/index.php?r=orders/change-status&id=${id}&status_id=${status_id}`;
    $.ajax({
        url: url,
        type: 'GET',
        success: function (json) {
            if(json.code==201){
                $(".column_status_"+id).text(name_status);
                $('#model').modal('hide');
                $('#modelContent').html("");

            }else {
                alert("sumthing  error");
            }
        }
    });

});


$(document).on('click', '.change-status-all', function(e){
    e.preventDefault();
    var id_string= $(this).attr("att_id_string");
    var status_id= $(this).attr("att_status_id");
    var name_status= $(this).attr("name_status");
    let url= `${SITE_URL}/index.php?r=orders/change-status-selected&name_status=${name_status}&status_id=${status_id}&string_id=${id_string}`;
    $.ajax({
        url: url,
        type: 'GET',
        success: function (json) {
          
            if(json.code==201){
                
            $.each(json.data, function( index, value ) {
                console.log("value",value);
                console.log("name_status",name_status);
                $(".column_status_"+value.id).text(name_status);
            });
                
                $('#model').modal('hide');
                $('#modelContent').html("");

            }else {
                alert("sumthing  error");
            }
        }
    });

});


function profit_margin_fn(){
    let profit_margin=0;
    let discount=0;
    console.log( $("#discount").val())
    if(!isNaN($("#discount").val()) && $("#discount").val() !=""  ){
        discount=parseFloat($("#discount").val());
    }
      $(".profits_margin").each(function( index, element  ) {
          profit_margin+= parseFloat ($(element ).val());
      });
    console.log("(profit_margin).toFixed(2)",(profit_margin).toFixed(2))
      profit_margin=profit_margin - discount;
    $('#profit_margin').val((profit_margin).toFixed(2));
}

function options_sub_product(data, _this){
    let  html=`<option value="">------</option>`;
    let selected=0
     data.forEach((element,index) => {
          html+=`<option value="${element.id}"> ${element.type}</option>`;
         selected=element.id;
     });
     $(_this).closest(".row").find(".sub_product_id").html(html);
    $(_this).closest(".row").find(`.sub_product_id option[value='${selected}']`).attr('selected', 'selected');
    $(_this).closest(".row").find(`.sub_product_id option[value='${selected}']`).attr('selected', 'selected');
    $(_this).closest(".row").find(`.sub_product_id option[value='${selected}']`).trigger('change');

 }

 function header_product_card(quantity,quantity_item,price,_this){
     $(_this).closest(".item").find(".span_quantity_all").text(quantity);
     $(_this).closest(".item").find(".span_quantity_item").text(quantity_item);
     $(_this).closest(".item").find(".span_price_items").text(price);
}

function set_value_heddin(data,product,_this){
    $(_this).closest(".row").find(".price").val(product.selling_price);
    let quantity= parseInt($(_this).closest(".row").find(".quantity_sub_product").val());
    let profit_margin= product.selling_price - product.purchasing_price;
    let discount=0;
    if($("#discount").val() != "" && $("#discount").val() != undefined){
        discount = parseInt($("#discount").val()) ;
    }
    $(_this).closest(".row").find(".price_item_count").val(product.selling_price * quantity);
    let profits_margin=(quantity*profit_margin)-discount;
    $(_this).closest(".row").find(".profits_margin").val(profits_margin);
    $(_this).closest(".row").find(".profit_margin").val((profit_margin/quantity).toFixed(2));
}


$(document).ready(function () {
    $("#ordernow").click(function() {
        $('html, body').animate({
            scrollTop: $("#order_landig").offset().top - 50
        }, 600);
        $( ".productmainbtn" ).fadeOut( "slow", function() {
            // Animation complete.
          });
        return false;
    });
});


$(document).ready(function () {
    setTimeout(function() {
        $(".form-group").each(function( index,element ) {
            if($(this).hasClass("has-error")){
                $("#ordernow").click();
            }
          });
    }, 1000);


   
});


var order_landig_top=1;

window.onscroll = function() {fade_in_out_button()};




let page=2;

$(window).scroll(function() {
    let full_path=window.location.href;
    var splitstring =full_path.split("?");
    console.log("splitstring",splitstring[1])
    if(splitstring[1] == "undefined" || splitstring[1] == undefined || splitstring[1]=='r=site/index' ||  splitstring[1]=='r=site%2Findex'){
        if($(window).scrollTop() == $(document).height() - $(window).height())
        {
             var url=`${SITE_URL}/index.php?r=product/load-more&page=${page}`;
               show_loader();

               $.ajax({
                    url: url,
                    success: function(result){
                        appaend_products(result)
                        hide_loader();
                        page++;

                    }
                });

        }
    }
});

function appaend_products(result){

    let content="";
    var path='';
    var image_path='';
    result.forEach(function(product) {
        path=`'${SITE_URL}/index.php?r=product/view&id=${product.id}'`;
        image_path=SITE_URL+'/'+product.thumbnail;
        content+='<div class="col-md-4"> \n'+
        '<div class="card" onclick="window.location.href ='+path+'"> \n'+
            '<img src="'+SITE_URL+'/'+product.thumbnail+'"   alt="" style="width:100%;" />\n'+
            '<h1>'+product.name+' </h1> \n'+
            '<p class="price"> $ '+product.selling_price+'</p>\n'+
            '<p >'+product.description+'</p>\n'+
            '<p><a hrf="'+path+'" class="btn  btn-green"> تفاصيل أكثر  <span class="glyphicon glyphicon-eye-open" ></span> </a>\n'+
            '</p> \n'+
        '</div>\n'+
        '</div>';





    });




    console.log(content);
    $("#list-products").append(content);

}



function fade_in_out_button() {
    try{

        order_landig_top=$("#order_landig").offset().top - window.pageYOffset - 120
        if(order_landig_top < document.documentElement.scrollTop){
            $( ".productmainbtn" ).fadeOut( "slow", function() {
                // Animation complete.
              });
        }else{
            $( ".productmainbtn" ).fadeIn( "slow", function() {
                // Animation complete.
              });
        }

        console.log(order_landig_top ,document.documentElement.scrollTop,window.pageYOffset)
    }catch(error){

    }






}

function show_loader(){
 $(".loader").show();
}
function hide_loader(){
    $(".loader").hide();

}

// View an image.

window.addEventListener('DOMContentLoaded', function () {
    try{
        var galley = document.getElementById('galley');
        var viewer = new Viewer(galley, {
            url: 'data-original',
            title: function (image) {
                return image.alt + ' (' + (this.index + 1) + '/' + this.length + ')';
            },
        });

        var galley2 = document.getElementById('pic-1');
        var viewer2 = new Viewer(galley2, {
            url: 'data-original',
            title: function (image) {
                return image.alt + ' (' + (this.index + 1) + '/' + this.length + ')';
            },
        });
    }catch(error){

    }




});

let ides=[];

$(document).on('click','#print_all_invoice',function (e) {
    ides=[];
    $('input[type=checkbox]').each(function () {
        if (this.checked) {
            ides.push($(this).val())  
        }
    });
     each_invoice(ides);
});


$(document).on('click','#export_pdf',function (e) {
    let selected=get_seletcted();
    ides=[];
    let string_id=selected.string_id;
    ides=selected.ides;

    if(ides.length==0){
        alert("select orders");
        return;
    }
    string_id=string_id.slice(0, -1)
    let url= `${SITE_URL}/index.php?r=orders/export-pdf&string_id=${string_id}`;
    window.open(url);
    
});


$(document).on('click','#change_status',function (e) {
    let selected=get_seletcted();
    ides=[];
    let string_id=selected.string_id;
    ides=selected.ides;
    if(ides.length==0){
        alert("select orders");
        return ;
    }
    string_id=string_id.slice(0, -1);
    let url= `${SITE_URL}/index.php?r=orders/set-status-selected&string_id=${string_id}`;

    $('#model').modal('show')
        .find('#modelContent')
        .load(url);

});
function get_seletcted(){
    let idses=[];
    let string_id="";
    $('input[type=checkbox]').each(function () {
        if (this.checked) {
            if(!$(this).hasClass('select-on-check-all')){
                string_id+=`${$(this).val()},`;
                idses.push($(this).val());
            }
        }
    }); 
    
    return { 'ides':idses, 'string_id':string_id };
}


$(document).on('click','#delete_orders',function (e) {

    let selected=get_seletcted();
    ides=[];
    let string_id=selected.string_id;
    ides=selected.ides;
    if(ides.length==0){
        alert("select orders");
        return;
    }
    string_id=string_id.slice(0, -1)
    let url= `${SITE_URL}/index.php?r=orders/delete-order-selected&string_id=${string_id}`;

    var r = confirm("do yo want delete all selected !");
    if (r == true) {

        $.ajax({
            url: url,
            type: 'POST',
            success: function (json) {
                location.reload();
            }
        });

    }

});


function each_invoice(ides){
    for(let i=0;i<ides.length;i++){
        setTimeout(function() {
            timer_invoice(ides[i]);
         }, 7000 * i)
     }     
}

function timer_invoice(id) {
    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
    width=600,height=300,left=100,top=100`;
    let url =`${SITE_URL}/index.php?r=orders/bill&id=${id}`;
    tab = window.open(url, "NewsWindow", params);
    // tab.print();
    tmot = setTimeout(function(){tab.close()}, 4000);
   
}

/*
var keys = $("#kv-grid-demo").yiiGridView("getSelectedRows").length;
 alert(keys > 0 ? "Downloaded " + keys + " selected books to your account." : "No rows selected for download.");
 */



$(document).on('click','#send_fast_order',function (event) {
    event.preventDefault(); // stopping submitting
    var data = $(".fast-order-form").serializeArray();
    var id= $(".fast-order-form").attr('att_id');
    var url = $(".fast-order-form").attr('action')+"&id="+id;

    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data
    })
        .done(function(response) {
            if (response.data.success == true) {
                Swal.fire('success add order');
                $.each($('input[type=text]'), function( key, value ) {
                   $(this).val("");
                });

                $("#div_errors").fadeOut(); 
                 $("#div_errors").html("");
            }else{
                var string_error="";
                var errors=response.data.errors;
                $( errors).each(function( index,error ) {
                    $.each( error, function( key, value ) {
                        string_error+=value[0]+"<br />";
                      });

                  });
                  $("#div_errors").fadeIn(); 
                 $("#div_errors").html(string_error);
            }
        })
        .fail(function() {
            console.log("error");
        });

});
jQuery(document).ready(function($) {
    $(".fast-order-form").submit(function(event) {
        event.preventDefault(); // stopping submitting
        var data = $(this).serializeArray();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data
        })
            .done(function(response) {
                if (response.data.success == true) {
                    alert("Wow you commented");
                }
            })
            .fail(function() {
                console.log("error");
            });
    });
});




 function callculate_all(){
    callculate_amount_required();
    callculate_total_price();
     profit_margin_fn();
}

function get_product(_this){
    let product_id_str=$(_this).attr('id');
    let url= `${SITE_URL}/index.php?r=products/get-product&id=${$(_this).val()}`;
    $.ajax({
        url: url,
        type: 'GET',
        success: function (json) {
            let data=json.data;
            let product=json.product;
           options_sub_product(data,_this);
           header_product_card(product.quantity,data[0].count,product.selling_price ,_this);
           set_value_heddin(data,product,_this);
           callculate_all();
        }
    });
}


function get_sub_product(_this){
    let url= `${SITE_URL}/index.php?r=sub-product-count/get-sub-product&id=${$(_this).val()}`;
    let product_id_str=$(_this).attr('id');
     $.ajax({
         url: url,
         type: 'GET',
         success: function (json) {
            $(_this).closest(".row").find(".quantity_sub_product").attr("max",json.data.sub_product.count);
             $(_this).closest(".item").find("span_quantity_item").text(json.data.sub_product.count);

         }
     });
 }





 $( document ).ready(function() {
    
    $(document).on('click','#send_order',function (e) {
          e.preventDefault();

          var $btn = $(this);
          $btn.button('loading');
         
            $('#send_order').attr('disabled','disabled');
            $btn.button('loading');
            $("#order_landig").submit();
            setTimeout(function(){ 
                var form = $("#order_landig");
                if(form.find('.has-error').length) {
                    hide_loader();
                    $('#send_order').prop('disabled',false);
                    $btn.button('reset');
                    return false;

                }else{
                   hide_loader();
                    $('#send_order').prop('disabled',true);
                    $btn.button('reset');
                }
            
            }, 
            1000);
            
        });
    
});  


 