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
     let count_sub_product=0;
    $( '.count_sub_product' ).each(function( index, element  ) {
        count_sub_product+= parseInt ($(element ).val());
      });
     
     if(! isNaN($('#quantity').val())){
         $("#quantity").val(count_sub_product);
     }
    callculate_all();
});
 

$(document).on('change','#delivery_price',function (e) {
     callculate_all();  
});

function callculate_total_price(){

    let total_price=0
    $(".price_item_count").each(function( index, element  ) {
        total_price+= parseInt ($(element ).val());
    });
  
    $("#total_price").val(total_price);
    return total_price;

    
}


function callculate_amount_required(){

    let amount_required=0;
    let delivery_price=0;
    let discount=0;
    if(!isNaN($("#discount").val())){
        discount= parseInt( $("#discount").val());
    }
     delivery_price= parseInt( $("#delivery_price").val());
     
    $(".price_item_count").each(function( index, element  ) {
        amount_required+= parseInt ($(element ).val());
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
            let html='';
            let data=json.data;
            let product= json.product;
            let count_all=0;
            let quantity_item=0;
            let price =product.selling_price; 
            
            let profit_margin = parseInt(product.selling_price) - parseInt(product.purchasing_price);
            $("#price_items_"+index).text(price);
            let count_sub_product=$("#ordersitem-"+index+"-quantity").val();
            let price_item_price_count=price * count_sub_product;

            $("#price_item_"+index).val(price_item_price_count);

            console.log("price_item_price_count",price_item_price_count);
            console.log("index",index);

            data.forEach((element,index) => {
                if(index==0){
                    quantity_item+=element.count; 
                }
                count_all+=element.count;
                html+=`<option value="${element.id}"> ${element.type}</option>`; 
            });
           
            $("#quantity_item_"+index).text(quantity_item);
            $("#ordersitem-"+index+"-quantity").attr('max',quantity_item);
            $("#quantity_all_"+index).text(count_all);
            $("#ordersitem-"+index+"-sub_product_id").html(html);
            $("#price_"+index).val(price);
             $("#profit_margin_"+index).val(profit_margin);
             $("#profits_margin_"+index).val(profit_margin);

             
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

 $(document).on('change','.quantity_sub_product',function (e) {
    let quantity_sub_product =parseInt($(this).val());
    let total_price=0;
    let quantity_sub_product_id_str=$(this).attr('id'); 
    let index=quantity_sub_product_id_str.replaceAll('ordersitem-', '') ;//ordersitem-0-product_id
        index=index.replaceAll('-product_id', '');
        index=index.replaceAll('-quantity', '');
    let price= $("#price_"+index).val();
    let profit_margin= parseInt($("#profit_margin_"+index).val());
    if(quantity_sub_product != '' && quantity_sub_product !='undefined' && ! isNaN(quantity_sub_product )){
        $("#profits_margin_"+index).val(profit_margin*quantity_sub_product);
         $("#price_item_"+index).val(price * quantity_sub_product);
    }
     
     $(".price_item_count").each(function( index, element  ) {
           total_price+= parseInt ($(element ).val());
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
$(document).on('change','.count_sub_product',function (e) {
    $('#quantity').prop( "disabled", true );
});


function profit_margin_fn(){
    let profit_margin=0;
    let discount=0;
    discount=parseInt($("#discount").val());
      $(".profits_margin").each(function( index, element  ) {
                profit_margin+= parseInt ($(element ).val());
          });

          profit_margin-=discount;
    $('#profit_margin').val(profit_margin);
}
