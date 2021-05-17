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
            'model' => $prices_delivery[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'region_id',
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
                <?php foreach ($prices_delivery as $in => $price_delivery) : ?>
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
                            if (!$price_delivery->isNewRecord) {
                                echo Html::activeHiddenInput($price_delivery, "[{$in}]id");
                            }
                            ?>

                            <div class="row">
                                <div class="col-sm-2">
                                    <?= $form->field($price_delivery, "[{$in}]region_id")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Region')) ?>
                                </div>
                                <div class="col-sm-8">
                                    <?= $form->field($price_delivery, "[{$in}]price")->textInput(['maxlength' => true,'class'=>'form-control'])
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



