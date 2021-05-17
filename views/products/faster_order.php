<?php

use app\models\products\Products;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="wrapper row">
    <div class="preview col-md-12">
        <?php $form = ActiveForm::begin(['id' => "order_landig"]); ?>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($modelOrder, 'name')->textInput(['maxlength' => true, 'required' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($modelOrder, 'phone')->textInput(['required' => true,'placeholder' => "07xxxxxxxx"]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($modelOrder, 'other_phone')->textInput(['placeholder' => "07xxxxxxxx"]) ?>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <?= $form->field($modelOrder, 'address')->textInput(['required' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($modelOrder, 'region_id')->widget(Select2::classname(), [
                    'data' =>  $regions,
                    'language' => 'ar',

                ]); ?>

            </div>
        </div>


        <div class="row">
            <?php if (count($model->subProductCount) >= 2 ) : ?>
                <div class="col-md-6">
                    <?= $form->field($modelOrder, 'type')->dropDownList(ArrayHelper::map($model->subProductCount, 'id', 'type')) ?>
                </div>
            <?php else : ?>
                <?= $form->field($modelOrder, 'type')->hiddenInput(['value' => $model->subProductCount[0]->id])->label(false); ?>
            <?php endif; ?>

            <div class="col-md-6">
                <?php if ($model->type_options == Products::TYPE_CHOOSE_BOX) : ?>
                    <?php
                    $typeOptions= ArrayHelper::map($model->typeOptions, 'id', 'text');
                    $modelOrder->typeoption = array_key_first($typeOptions);;
                    ?>
                    <?= $form->field($modelOrder, 'typeoption')->radioList($typeOptions, ['style' => 'display: grid;']) ?>
                <?php else : ?>
                    <?= $form->field($modelOrder, 'typeoption')->dropDownList(ArrayHelper::map($model->typeOptions, 'id', 'text')) ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Order_Now') . ' <span class="glyphicon glyphicon-shopping-cart"> </span>', ['class' => 'btn btn-green btn-lg btn-block', 'id' => 'send_order']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>




    </div>
</div>
