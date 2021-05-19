<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php if (Yii::$app->session->has('message')) : ?>
    <?= Alert::widget([
    'options' => [
    'class' => 'alert-info',
    ],
    'body' => Yii::$app->session->get('message'),
    ]);?>
<?php Yii::$app->session->remove('message') ?>
<?php endif; ?>
<div class="advertisement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'adminEmail')->textInput(['maxlength' => true,'value'=>Yii::$app->params['adminEmail']]) ?>
    <?= $form->field($model, 'senderEmail')->textInput(['maxlength' => true,'value'=>Yii::$app->params['senderEmail']]) ?>
    <?= $form->field($model, 'senderName')->textInput(['maxlength' => true,'value'=>Yii::$app->params['senderName']]) ?>


    <?= $form->field($model, 'bsDependencyEnabled')->textInput(['maxlength' => true,'value'=>Yii::$app->params['bsDependencyEnabled']]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'value'=>Yii::$app->params['phone']]) ?>

    <?= $form->field($model, 'facebook_id')->textInput(['maxlength' => true,'value'=>Yii::$app->params['facebook_id']]) ?>
    <?= $form->field($model, 'sanpchat_id')->textInput(['maxlength' => true,'value'=>Yii::$app->params['sanpchat_id']]) ?>
    <?= $form->field($model, 'sanpchat_email')->textInput(['maxlength' => true,'value'=>Yii::$app->params['sanpchat_email']]) ?>
    <?= $form->field($model, 'tiktok_id')->textInput(['maxlength' => true,'value'=>Yii::$app->params['tiktok_id']]) ?>
    <?= $form->field($model, 'company_delivery')->textInput(['maxlength' => true,'value'=>Yii::$app->params['company_delivery']]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
