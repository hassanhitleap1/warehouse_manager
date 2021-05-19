<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php if (Yii::$app->session->has('message')) : ?>
    <div class="alert alert-success">
        <strong>Success!</strong> <?= Yii::$app->session->get('message') ?>
    </div>
<?php Yii::$app->session->remove('message') ?>
<?php endif; ?>
<div class="advertisement-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-2"> <?= $form->field($model, 'adminEmail')->textInput(['maxlength' => true,'value'=>Yii::$app->params['adminEmail']]) ?></div>
            <div class="col-md-2">  <?= $form->field($model, 'senderEmail')->textInput(['maxlength' => true,'value'=>Yii::$app->params['senderEmail']]) ?></div>
            <div class="col-md-2">  <?= $form->field($model, 'senderName')->textInput(['maxlength' => true,'value'=>Yii::$app->params['senderName']]) ?></div>
            <div class="col-md-2">   <?= $form->field($model, 'bsDependencyEnabled')->textInput(['maxlength' => true,'value'=>Yii::$app->params['bsDependencyEnabled']]) ?></div>
            <div class="col-md-2"><?= $form->field($model, 'phone')->textInput(['maxlength' => true,'value'=>Yii::$app->params['phone']]) ?></div>
            <div class="col-md-2"> <?= $form->field($model, 'facebook_id')->textInput(['maxlength' => true,'value'=>Yii::$app->params['facebook_id']]) ?></div>
        </div>
   
        <div class="row">
            <div class="col-md-3"> <?= $form->field($model, 'sanpchat_id')->textInput(['maxlength' => true,'value'=>Yii::$app->params['sanpchat_id']]) ?></div>
            <div class="col-md-3"> <?= $form->field($model, 'sanpchat_email')->textInput(['maxlength' => true,'value'=>Yii::$app->params['sanpchat_email']]) ?></div>
            <div class="col-md-3"> <?= $form->field($model, 'tiktok_id')->textInput(['maxlength' => true,'value'=>Yii::$app->params['tiktok_id']]) ?></div>
            <div class="col-md-3"><?= $form->field($model, 'company_delivery')->textInput(['maxlength' => true,'value'=>Yii::$app->params['company_delivery']]) ?></div>
        </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
