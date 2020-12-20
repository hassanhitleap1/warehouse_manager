let SITE_URL = getSiteUrl() ;
$(document).on('change','#region_id',function (e) {
    let url= `${SITE_URL}/index.php?r=regions/get-price&id=${$(this).val()}`;
   
     $.ajax({
         url: url,
         type: 'GET',
        
         success: function (json) {
             delivery_price=json.data.price_delivery;
            $('#delivery_price').val(delivery_price);
         }
     });
 });

 $(document).on('change','#discount',function (e) {
   let total_price=$('#total_price').val();
   let discount=$('#discount').val();
   let amount_required=total_price-discount;
     $('#amount_required').val(amount_required);
 });
 $(document).on('keyup','.count_sub_product',function (e) {
     let count_sub_product=0;
    $( '.count_sub_product' ).each(function( index, element  ) {
        count_sub_product+= parseInt ($(element ).val());
      });
      $("#quantity").val(count_sub_product)

});
 

$(document).on('change','#delivery_price',function (e) {
    let delivery_price= parseInt($(this).val());
    
    let discount= parseInt($("#discount").val());
             
    $(".price_item_count").each(function( index, element  ) {
         console.log($(element ).val());
        total_price+= parseInt ($(element ).val());
   });

   total_price+=delivery_price;

   let amount_required=total_price-discount;

   $("#amount_required").val(amount_required);
   $('#total_price').val(total_price);
});




function callculate_total_price(){
    let total_price-0;
     let delivery_price= parseInt( $("#delivery_price").val());
    $(".price_item_count").each(function( index, element  ) {
            total_price+= parseInt ($(element ).val());
     });
    
    total_price+=delivery_price;
     $("#total_price").val(total_price);
    return total_price;
    
}

function callculate_amount_required(){
    let discount= parseInt($("#discount").val());
    let delivery_price = ($('#delivery_price').val());
    let total_price= callculate_total_price();
    let amount_required=total_price-discount;
    
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
            let delivery_price= parseInt( $("#delivery_price").val());
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
            $("#ordersitem-"+index+"-id").html(html);
            $("#price_"+index).val(price);

           
             total_price=0;
             $(".selling_price").each(function( index, element  ) {
                total_price+= parseInt ($(element ).val());
              });
             count_items=$("#ordersquinttay").val();
             
             let discount= $("#discount").val();
             

    

            $(".price_item_count").each(function( index, element  ) {
                 console.log($(element ).val());
                total_price+= parseInt ($(element ).val());
           });

           total_price+=delivery_price;

           let amount_required=total_price-discount;

           $("#amount_required").val(amount_required);
           $('#total_price').val(total_price);
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

      let quantity_sub_product =$(this).val();
     
     let total_price=0;
     let quantity_sub_product_id_str=$(this).attr('id'); 
    let index=quantity_sub_product_id_str.replaceAll('ordersitem-', '') ;//ordersitem-0-product_id
        index=index.replaceAll('-product_id', '');
        index=index.replaceAll('-quantity', '');
     let price= $("#price_"+index).val();
        
     if(quantity_sub_product != '' && quantity_sub_product !='undefined'){
        
         $("#price_item_"+index).val(price * quantity_sub_product);
     }
     
     $(".price_item_count").each(function( index, element  ) {
            console.log($(element ).val())
           total_price+= parseInt ($(element ).val());
      });

      let amount_required=total_price-discount;
      $("#total_price").val(total_price);
     $("#amount_required").val(total_price);

});


 function getSiteUrl() {
    let site_url=window.location.host;
    if (site_url=='localhost:8080'){
        return '';
    }
    return site_url+'/web';
}





$(document).on('change','.count_sub_product',function (e) {
    $('#quantity').prop( "disabled", true );
});
