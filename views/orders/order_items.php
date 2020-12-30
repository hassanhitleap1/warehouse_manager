<?php

use app\models\products\Products;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
$quantity_item=1;
$products=ArrayHelper::map(Products::find()->all(), 'id', 'name');
array_unshift($products,'-----');
?>
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
            ],
        ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i>
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
                                <span><?=Yii::t('app','Quantity_All')?> : <span id="quantity_all_<?= ($index)?>"></span> </span>
                                /
                                <span><?=Yii::t('app','Quantity_Item')?> : <span id="quantity_item_<?= ($index)?>"></span>  </span>
                                /
                                <span><?=Yii::t('app','Price')?> : <span class="price_item" id="price_items_<?= ($index)?>"></span>  </span>
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
                               <input type="hidden" class="price" id="price_<?=$index?>" name="price" value="0">
                                <input type="hidden" class="price_item_count" id="price_item_<?=$index?>" name="price_itme_count" value="0">
                                <input type="hidden" class="profit_margin" id="profit_margin_<?=$index?>" name="profit_margin" value="0">
                                  <input type="hidden" class="profits_margin" id="profits_margin_<?=$index?>" name="profits_margin" value="0">
                                <div class="col-sm-4">
                                    <?= $form->field($orderItem,"[{$index}]product_id")->widget(Select2::classname(), [
                                            'data' => $products,
                                            'language' => 'ar',
                                            'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'class'=>'product_id'],
                                        
                                        ]); ?>  

                                </div>
                                <div class="col-sm-4">
                                     <?= $form->field($orderItem, "[{$index}]sub_product_id")->dropDownList([],['class'=>'form-control sub_product_id'])->label(Yii::t('app','Sub_Product_Id'))?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($orderItem, "[{$index}]quantity")->textInput([
                                        'class'=>'form-control quantity_sub_product','type' => 'number','min'=> 1 ,'value'=>$quantity_item])?>
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
            $("#ordersitem-"+(index+1)+"-quantity").val(1);
            $("#price_item_0"+(index+1)).attr('id',"price_item_"+(index+1));
            $("#price_0"+(index+1)).attr('id',"price_"+(index+1));
            $("#price_items_0"+(index+1)).attr('id',"price_items_"+(index+1));
            $("#quantity_all_0"+(index+1)).attr('id',"quantity_all_"+(index+1));
            $("#quantity_item_0"+(index+1)).attr('id',"quantity_item_"+(index+1));
            $("#profit_margin_0"+(index+1)).attr('id',"profit_margin_"+(index+1));
            $("#profits_margin_0"+(index+1)).attr('id',"profits_margin_"+(index+1));
            
        }, 1000);;
        
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
