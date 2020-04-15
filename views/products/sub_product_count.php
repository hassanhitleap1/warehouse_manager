<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Html;

?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper_sub_product_counts', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items_sub_product_counts', // required: css class selector
            'widgetItem' => '.item-sub-product-count', // required: css class
            'limit' => 15, // the maximum times, an element can be cloned (default 999)
             'min' => 1                                                                                                                                                                                                                                                                                             , // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $subProductCounts[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'type',
                'count',
            ],
        ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i><?= Yii::t('app','Add_Sub_Product')?></button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items_sub_product_counts"><!-- widgetContainer -->
                <!-- widgetContainer -->
                <?php foreach ($subProductCounts as $index => $subProductCount) : ?>
                    <div class="item-sub-product-count panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-_sub_product_counts">  : <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$subProductCount->isNewRecord) {
                                echo Html::activeHiddenInput($subProductCount, "[{$index}]id");
                            }
                            ?>

                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($subProductCount, "[{$index}]type")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Type')) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($subProductCount, "[{$index}]count")->textInput(['maxlength' => true,'class'=>'form-control count_sub_product'])
                                        ->label(Yii::t('app', 'Count'))  ?>
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




<script  type="text/javascript">

//    var title_Sub_Product='<?//= Yii::t('app','Sub_Product')?>//';
//    jQuery(".dynamicform_wrapper_sub_product_counts").on("afterInsert", function(e, item) {
//        jQuery(".dynamicform_wrapper_sub_product_counts .panel-title-_sub_product_counts").each(function(index) {
//            jQuery(this).html(title_Sub_Product +" :" + (index + 1));
//        });
//    });
//
//    jQuery(".dynamicform_wrapper_sub_product_counts").on("afterDelete", function(e) {
//        jQuery(".dynamicform_wrapper_sub_product_counts .panel-title-_sub_product_counts").each(function(index) {
//            jQuery(this).html(title_Sub_Product +" :" + (index + 1));
//        });
//    });
//
$(".remove-item").on("click", function(e) {
   callculate_count_sub_product();
});
</script>