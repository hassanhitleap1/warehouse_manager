<?php

use app\models\ordersitem\OrdersItem;
use app\models\products\Products;
use app\models\subproductcount\SubProductCount;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use kartik\touchspin\TouchSpin;
$quantity_item=1;
$products=ArrayHelper::map(Products::find()->orderBy(['id' => SORT_DESC])->all(), 'id', 'name');
$products[0]='-----';
$product_items[0]=[];
$price[0]=0;
$price_item_count[0]=0;
$profit_margin[0]=0;
$profits_margin[0]=0;

if (!$model->isNewRecord) {
    foreach($ordersItem as $key=> $orderItem){
        $product_items[$key]=ArrayHelper::map(SubProductCount::find()->where(['product_id'=>$orderItem->product_id])->all(), 'id', 'type');
        $product_items[$key][0]='-----';
        $price[$key]=$orderItem->price;
        $price_item_count[$key]=$orderItem->price_item_count;
        $profit_margin[$key]=$orderItem->profit_margin;
        $profits_margin[$key]=$orderItem->profits_margin;
    }
}
?>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

<div class="panel panel-default">
    <div class="panel-body">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 15, // the maximum times, an element can be cloned (default 999)
             'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $ordersItem[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'product_id',
                'sub_product_id',
                'quantity',
                'price',
                'price_item_count',
                'profit_margin',
                'profits_margin'
            ],
        ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> <?=Yii::t('app','Add_Product')?> </button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
                <!-- widgetContainer -->
                <?php foreach ($ordersItem as $index => $orderItem) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address">  : <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            <div class="pull-left">
                                <span><?=Yii::t('app','Quantity_All')?> : <span class="span_quantity_all"></span> </span>
                                /
                                <span><?=Yii::t('app','Quantity_Item')?> : <span  class="span_quantity_item" ></span>  </span>
                                /
                                <span><?=Yii::t('app','Price')?> : <span class="span_price_items" ></span>  </span>
                            </div>
                
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$orderItem->isNewRecord) {
                                echo Html::activeHiddenInput($orderItem, "[{$index}]id");
                            }
                            ?>

                            <div class="row">
                                <?=$form->field($orderItem, "[{$index}]price")->hiddenInput(['class'=>"price",'value'=>$price[$index]])->label(false);?>
                                <?=$form->field($orderItem, "[{$index}]price_item_count")->hiddenInput(['class'=>"price_item_count", 'value'=>$price_item_count[$index]  ])->label(false);?>
                                <?=$form->field($orderItem, "[{$index}]profit_margin")->hiddenInput(['class'=>"profit_margin",'value'=>$profit_margin[$index]])->label(false);?>
                                <?=$form->field($orderItem, "[{$index}]profits_margin")->hiddenInput(['class'=>"profits_margin",'value'=>$profits_margin[$index]])->label(false);?>

                                <div class="col-sm-4">
                                    <?= $form->field($orderItem,"[{$index}]product_id")->widget(Select2::classname(), [
                                            'data' => $products,
                                            'language' => 'ar',
                                            'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'class'=>'product_id'],
                                        
                                        ]); ?>  
                                </div>
                                <div class="col-sm-4">
                                     <?= $form->field($orderItem, "[{$index}]sub_product_id")->dropDownList($product_items[$index],['class'=>'form-control sub_product_id'])->label(Yii::t('app','Sub_Product_Id'))?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($orderItem, "[{$index}]quantity")->widget(TouchSpin::classname(), [
                                      'options' => ['class' => 'quantity_sub_product'],
                                        'pluginOptions' => [
                                            'min' => 0,
                                            'max' => 100,
                                            'initval'=>$quantity_item,
                                            'buttonup_class' => 'btn btn-primary', 
                                            'buttondown_class' => 'btn btn-info', 
                                            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign "></i>', 
                                            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign "></i>'
                                        ]
                                    ]);
                                    
                                    ?>
                                   
                                </div>
                             
                            </div><!-- end:row -->  


                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <?php DynamicFormWidget::end(); ?>
    </div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script  type="text/javascript">

$(".add-item").on("click", function(e) {
    
    reload_js_select2();
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        setTimeout(function(){
            $('.container-items .item:last-child').find(".product_id option[value='0']").attr('selected', 'selected');
            $('.container-items .item:last-child').find(".product_id option[value='0']").attr('selected', 'selected');
            $('.container-items .item:last-child').find(".product_id option[value='0']").trigger('change');
            $('.container-items .item:last-child').find(".sub_product_id option[value='0']").attr('selected', 'selected');
            $('.container-items .item:last-child').find(".sub_product_id option[value='0']").attr('selected', 'selected');
            $('.container-items .item:last-child').find(".sub_product_id option[value='0']").trigger('change');
            $('.container-items .item:last-child').find(".quantity_sub_product").val(0);
            $('.container-items .item:last-child').find(".price").val(0);
            $('.container-items .item:last-child').find(".price_item_count").val(0);
            $('.container-items .item:last-child').find(".profit_margin").val(0);
            $('.container-items .item:last-child').find(".profits_margin").val(0);

            $('.container-items .item:last-child').find(".quantity_sub_product").val(1);

        }, 1000);
        
    });
});

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1));
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1));
        callculate_all();  
    });
});


</script>
