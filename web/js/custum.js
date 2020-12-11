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
 
 function getSiteUrl() {
    let site_url=window.location.host;
    if (site_url=='localhost:8080'){
        return '';
    }
    return site_url+'/web';
}