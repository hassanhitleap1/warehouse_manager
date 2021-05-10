<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\campaigncampaigngroupselected\CampaignGroupSelected */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaign-group-selected-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'campaign_id')->textInput() ?>

    <?= $form->field($model, 'groups_subscribe_id')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
