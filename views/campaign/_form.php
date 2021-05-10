<?php


use app\models\groupssubscribe\GroupsSubscribe;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\campaign\Campaign */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaign-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->textInput() ?>
    <?= $form->field($model, 'campaign_group_selected')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(GroupsSubscribe::find()->all(), 'id', 'name'),
        'language' => 'ar',
        'options' => [
            'placeholder' => 'Select campaign group selected ...',
            'multiple' => true
        ]


    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
