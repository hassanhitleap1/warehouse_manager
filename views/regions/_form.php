<?php

use app\models\countries\Countries;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\regions\Regions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_delivery')->textInput() ?>


    <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Countries::find()->all(), 'id', 'name_ar'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
