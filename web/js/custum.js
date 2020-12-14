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
 


$(document).on('change','.product_id',function (e) {
    let url= `${SITE_URL}/index.php?r=sub-product-count/get-product-items&id=${$(this).val()}`;
    let product_id_str=$(this).attr('id'); 
    let index=product_id_str.replaceAll('ordersitem-', '') ;//ordersitem-0-product_id
    index=index.replaceAll('-product_id', '');
    index=index.trim()
    console.log(index);

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
             
            $(".selling_price").val(product.selling_price);
             
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
              $("#price_item_"+index).val(price * 1);
             total_price=0;
             $(".selling_price").each(function( index, element  ) {
                total_price+= parseInt ($(element ).val());
              });
             count_items=$("#ordersquinttay").val();
             
             $("#total_price").val(total_price);
             
             let discount= $("#discount").val();
             
             let amount_required=total_price-discount;
             
             $("#amount_required").val(amount_required * count_items);
             
             

         }
     });
 });


 $(document).on('keyup','.quantity_sub_product',function (e) {
  let quantity_sub_product =$(this).val();
     let total_price=0;
     let quantity_sub_product_id_str=$(this).attr('id'); 
    let index=quantity_sub_product_id_str.replaceAll('ordersitem-', '') ;//ordersitem-0-product_id
        index=index.replaceAll('-product_id', '');
     let price= $("#price_"+index).val();
     if(quantity_sub_product != '' && quantity_sub_product !='undefined'){
         $("#price_item_"+index).val(price * quantity_sub_product);
     }
     
     $(".price_item").each(function( index, element  ) {
           total_price+= parseInt ($(element ).val());
      });
     $("#total_price").val(total_price);

});


 function getSiteUrl() {
    let site_url=window.location.host;
    if (site_url=='localhost:8080'){
        return '';
    }
    return site_url+'/web';
}
