<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Html;

?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper_type_options', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items-type_option', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 15, // the maximum times, an element can be cloned (default 999)
             'min' => 1                                                                                                                                                                                                                                                                                             , // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $type_options[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'number',
                'text',
                'price'
            ],
        ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
         
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i><?= Yii::t('app','Type_Options')?></button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items-type_option"><!-- widgetContainer -->
                <!-- widgetContainer -->
                <?php foreach ($type_options as $in => $type_option) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-type-options">  : <?= ($in + 1) ?></span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$type_option->isNewRecord) {
                                echo Html::activeHiddenInput($type_option, "[{$in}]id");
                            }
                            ?>

                            <div class="row">
                                <div class="col-sm-2">
                                    <?= $form->field($type_option, "[{$in}]number")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Number')) ?>
                                </div>
                                <div class="col-sm-8">
                                    <?= $form->field($type_option, "[{$in}]text")->textInput(['maxlength' => true,'class'=>'form-control'])
                                        ->label(Yii::t('app', 'Text'))  ?>
                                </div>
                                <div class="col-sm-2">
                                    <?= $form->field($type_option, "[{$in}]price")->textInput(['maxlength' => true,'class'=>'form-control'])
                                        ->label(Yii::t('app', 'Price'))  ?>
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
    //var title_Type_Options='<?//= Yii::t('app','Type_Options')?>//';
    //$(".dynamicform_wrapper_type_options").on("beforeInsert", function(e, item) {
    //    jQuery(".dynamicform_wrapper_type_options .panel-title-type-options").each(function(index) {
    //               jQuery(this).html(title_Type_Options +" :" + (index + 1));
    //           });
    //});

    //var title_Type_Options='<?//= Yii::t('app','Type_Options')?>//';
    //jQuery(".dynamicform_wrapper_type_options").on("afterInsert", function(e, item) {
    //    jQuery(".dynamicform_wrapper_type_options .panel-title-type-options").each(function(index) {
    //        jQuery(this).html(title_Type_Options +" :" + (index + 1));
    //    });
    //});
    //jQuery(".dynamicform_wrapper_type_options").on("afterDelete", function(e) {
    //    jQuery(".dynamicform_wrapper_type_options .panel-title-type-options").each(function(index) {
    //        jQuery(this).html(title_Type_Options" :" + (index + 1));
    //    });
    //});
</script>


