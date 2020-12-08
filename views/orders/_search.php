<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker
use kartikorm\ActiveForm
    
    
    

/* @var $this yii\web\View */
/* @var $model app\models\orders\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    
    <?=  DatePicker::widget([
    'model' => $model,
    'attribute' => 'delivery_date',
    'attribute2' => 'delivery_date',
    'options' => ['placeholder' => 'Start date'],
    'options2' => ['placeholder' => 'End date'],
    'type' => DatePicker::TYPE_RANGE,
    'form' => $form,
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose' => true,
    ]
    ]);?>

    <?=  // echo  $form->field($model, 'id') ?>

    <?=  // echo  $form->field($model, 'order_id') ?>

    <?=  // echo  $form->field($model, 'user_id') ?>

    <?=  // echo $form->field($model, 'delivery_date') ?>

    <?=  // echo  $form->field($model, 'delivery_time') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'region_id') ?>

    <?php // echo $form->field($model, 'area_id') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
