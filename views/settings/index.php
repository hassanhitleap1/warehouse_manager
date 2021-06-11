<?php

use app\models\companydelivery\CompanyDelivery;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$placeholder_massage_whatsapp="شكرا لطلبك من name_of_store لقد طلبت order بسعر price ";

$dataThumbnail = [
    'showCaption' => true,
    'showRemove' => true,
    'showUpload' => false,
    'initialPreview' => [
        Yii::getAlias('@web') . '/images/logo.png',
    ],
    'initialPreviewAsData' => false,
    'initialCaption' => Yii::getAlias('@web') .  '/images/logo.png',
    'initialPreviewConfig' => [
        ['caption' => 'logo'],
    ],
    'overwriteInitial'=>true

];

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
            <div class="col-md-2"> <?= $form->field($model, 'name_of_store')->textInput(['maxlength' => true,'value'=>$params['name_of_store']]) ?></div>
            <div class="col-md-2">  <?= $form->field($model, 'senderEmail')->textInput(['maxlength' => true,'value'=>$params['senderEmail']]) ?></div>
            <div class="col-md-2">  <?= $form->field($model, 'senderName')->textInput(['maxlength' => true,'value'=>$params['senderName']]) ?></div>
            <div class="col-md-2">   <?= $form->field($model, 'bsDependencyEnabled')->textInput(['maxlength' => true,'value'=>$params['bsDependencyEnabled']]) ?></div>
            <div class="col-md-2"><?= $form->field($model, 'phone')->textInput(['maxlength' => true,'value'=>$params['phone']]) ?></div>
            <div class="col-md-2"> <?= $form->field($model, 'facebook_id')->textInput(['maxlength' => true,'value'=>$params['facebook_id']]) ?></div>
        </div>
   
        <div class="row">
        <div class="col-md-2"> <?= $form->field($model, 'adminEmail')->textInput(['maxlength' => true,'value'=>$params['adminEmail']]) ?></div>
            <div class="col-md-2"> <?= $form->field($model, 'sanpchat_id')->textInput(['maxlength' => true,'value'=>$params['sanpchat_id']]) ?></div>
            <div class="col-md-2"> <?= $form->field($model, 'sanpchat_email')->textInput(['maxlength' => true,'value'=>$params['sanpchat_email']]) ?></div>
            <div class="col-md-2"> <?= $form->field($model, 'tiktok_id')->textInput(['maxlength' => true,'value'=>$params['tiktok_id']]) ?></div>
            <div class="col-md-3">
                <?= $form->field($model, 'company_delivery')->widget(Select2::classname(), [
                    'data' =>  ArrayHelper::map(CompanyDelivery::find()->all(), 'id', 'name'),
                    'language' => 'ar',
                    'options' => ['value' =>$params['company_delivery']],
                ]); ?>
            
            </div>
        </div>

        <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'massage_whatsapp')->textarea(['placeholder'=>$placeholder_massage_whatsapp,'value'=>$params['massage_whatsapp']]);
                    ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/png'],
                        'pluginOptions' => $dataThumbnail
                    ]);
                    ?>

                </div>
            </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
