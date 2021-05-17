<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pricecompanydelivery\PriceCompanyDelivery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-company-delivery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region_id')->textInput() ?>

    <?= $form->field($model, 'company_delivery_id')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
