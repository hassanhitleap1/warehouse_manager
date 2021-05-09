<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Subscribers\Subscribers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscribers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => []
                    ]);
                ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Import'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
