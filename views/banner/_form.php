<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\banner\Banner */
/* @var $form yii\widgets\ActiveForm */


$dataImage = [
    'showCaption' => true,
    'showRemove' => true,
    'showUpload' => false,
    'initialPreviewAsData' => false,
    'initialPreviewConfig' => [
        ['caption' => 'logo'],
    ],
    'overwriteInitial'=>true,
    'placeholder'=>Yii::t('app','Image')

];
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['accept' => 'image/*','placeholder'=>Yii::t('app','Logo')],
        'pluginOptions' => $dataImage
    ])->label(Yii::t('app','Image'));
    ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
