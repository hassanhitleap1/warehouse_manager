<?php

use app\models\products\Products;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OptionsSellProduct\OptionsSellProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="options-sell-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'price')->textInput()  ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(Products::find()->all(), 'id', 'name'),
        'language' => 'ar',

    ]); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
