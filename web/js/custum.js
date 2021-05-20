let SITE_URL = getSiteUrl() ;
$(document).on('change','#region_id',function (e) {
    let url= `${SITE_URL}/index.php?r=regions/get-price&id=${$(this).val()}`;
     $.ajax({
         url: url,
         type: 'GET',
         success: function (json) {
             delivery_price=json.data.price_delivery;
            $('#delivery_price').val(delivery_price);
              callculate_all();

         }
     });
 });


function callculate_all(){
    callculate_amount_required();
    callculate_total_price();
     profit_margin_fn();
}



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
    let total_price=0
    $(".price_item_count").each(function( index, element  ) {
        total_price+= parseFloat ($(element ).val());
    });

    $("#total_price").val(total_price);
    return total_price;


}


function callculate_amount_required(){
    let amount_required=0;
    let delivery_price=0;
    let discount=0;
    if(!isNaN($("#discount").val())){
        discount= parseFloat( $("#discount").val());
    }
     delivery_price= parseFloat( $("#delivery_price").val());

    $(".price_item_count").each(function( index, element  ) {
        amount_required+= parseFloat ($(element ).val());
     });

     amount_required-=discount;
     amount_required+=delivery_price;
     $("#amount_required").val(amount_required);
    return amount_required;



}



$(document).on('change','.product_id',function (e) {
    let url= `${SITE_URL}/index.php?r=sub-product-count/get-product-items&id=${$(this).val()}`;
    let product_id_str=$(this).attr('id');
    let index=product_id_str.replaceAll('ordersitem-', '') ;//ordersitem-0-product_id
    index=index.replaceAll('-product_id', '');
    index=index.trim();
     $.ajax({
         url: url,
         type: 'GET',
         success: function (json) {
             let data=json.data;
             let product=json.product;
            options_sub_product(data,index);
            header_product_card(product.quantity,data[0].count,product.purchasing_price,index);
            set_value_heddin(data,product,index);
            callculate_all();
         }
     });
 });




$(document).on('change','.sub_product_id',function (e) {
    let url= `${SITE_URL}/index.php?r=sub-product-count/get-sub-product&id=${$(this).val()}`;
    let product_id_str=$(this).attr('id');
    let index=product_id_str.replaceAll('ordersitem-', '') ;//ordersitem-0-product_id
    index=index.replaceAll('-product_id', '');
    index=index.replaceAll('-id', '');
    index=index.replaceAll('-sub_product_id', '');
    index=index.trim()
     $.ajax({
         url: url,
         type: 'GET',
         success: function (json) {
             console.log(index);
            $("#quantity_item_"+index).text(json.data.sub_product.count);
            $("#ordersitem-"+index+"-quantity").attr('max',json.data.sub_product.count);
         }
     });
 });



 $(document).on('change keypress blur keyup','.quantity_sub_product',function (e) {
    let quantity_sub_product =parseInt($(this).val());
    let total_price=0;
    let quantity_sub_product_id_str=$(this).attr('id');
    let index=quantity_sub_product_id_str.replaceAll('ordersitem-', '') ;//ordersitem-0-product_id
        index=index.replaceAll('-product_id', '');
        index=index.replaceAll('-quantity', '');
    let price= $("#price_"+index).val();
    let profit_margin= parseFloat($("#profit_margin_"+index).val());
    if(quantity_sub_product != '' && quantity_sub_product !='undefined' && ! isNaN(quantity_sub_product )){
        $("#profits_margin_"+index).val(profit_margin*quantity_sub_product);
         $("#price_item_"+index).val(price * quantity_sub_product);
    }

     $(".price_item_count").each(function( index, element  ) {
           total_price+= parseFloat ($(element ).val());
      });

      let amount_required=total_price-discount;
      $("#total_price").val(total_price);
     $("#amount_required").val(total_price);
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
    var status_id= $(this).attr("att_id_string");
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
    discount=parseFloat($("#discount").val());
      $(".profits_margin").each(function( index, element  ) {
                profit_margin+= parseFloat ($(element ).val());
          });

          profit_margin-=discount;
    $('#profit_margin').val(profit_margin);
}

function options_sub_product(data,html_id){
    let  html=`<option value="">------</option>`;
     data.forEach((element,index) => {
          html+=`<option value="${element.id}"> ${element.type}</option>`;
     });
     let selector="#ordersitem-"+html_id+"-sub_product_id";
     $(selector).html(html);
 }

 function header_product_card(quantity,quantity_item,price,index){
    $("#quantity_item_"+index).text(quantity_item);
    $("#quantity_all_"+index).text(quantity);
    $("#price_items_"+index).text(price);
}

function set_value_heddin(data,product,index){
    $("#price_item_"+index).val(product.selling_price);
    $("#price_"+index).val(product.selling_price);
    let quantity=($("#ordersitem-"+index+"-quantity").val()!=undefined)?$("#ordersitem-"+index+"-quantity").val():-1;
    let profit_margin= product.selling_price - product.purchasing_price;
    $("#profit_margin_"+index).val(profit_margin);
    $("#profits_margin_"+index).val(quantity*profit_margin);
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
    if(splitstring[1] ==undefined || splitstring[1]=='r=site/index' ||  splitstring[1]=='r=site%2Findex'){
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
    ides=[];
    let string_id="";
    $('input[type=checkbox]').each(function () {
        if (this.checked) {
            string_id+=`${$(this).val()},`;
            ides.push($(this).val())  
        }
    });

    if(ides.length==0){
        alert("select orders")
    }
    string_id=string_id.slice(0, -1)
    let url= `${SITE_URL}/index.php?r=orders/export-pdf&string_id=${string_id}`;
    window.open(url);
    
});


$(document).on('click','#change_status',function (e) {
    ides=[];
    let string_id="";
    $('input[type=checkbox]').each(function () {
        if (this.checked) {
            string_id+=`${$(this).val()},`;
            ides.push($(this).val())
        }
    });
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

$(document).on('click','#delete_orders',function (e) {
    ides=[];
    let string_id="";
    $('input[type=checkbox]').each(function () {
        if (this.checked) {
            string_id+=`${$(this).val()},`;
            ides.push($(this).val())
        }
    });

    if(ides.length==0){
        alert("select orders");
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
