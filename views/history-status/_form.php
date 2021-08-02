<?php

use app\models\regions\Regions;
use app\models\status\Status;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\historystatus\HistoryStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(Status::find()->all(), 'id', 'name_ar'),
        'language' => 'ar',
    ]); ?>
    <?= $form->field($model, 'order_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
