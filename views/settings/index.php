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
    'overwriteInitial'=>true,
    'placeholder'=>Yii::t('app','Logo')

];
$this->title=Yii::t('app','Settings');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
            <div class="col-md-2">
                <?= $form->field($model, 'name_of_store')
                    ->textInput(['maxlength' => true,'value'=>$params['name_of_store'],
                        'placeholder'=>Yii::t('app','Name_Of_Store')])
                        ->label(false)
                    ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'senderEmail')
                    ->textInput(['maxlength' => true,'value'=>$params['senderEmail'],
                        'placeholder'=>Yii::t('app','SenderEmail')])
                    ->label(false) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'senderName')
                    ->textInput(['maxlength' => true,'value'=>$params['senderName'],
                        'placeholder'=>Yii::t('app','SenderName')])
                    ->label(false)?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'bsDependencyEnabled')
                    ->textInput(['maxlength' => true,'value'=>$params['bsDependencyEnabled'],
                        'placeholder'=>Yii::t('app','BsDependencyEnabled')])
                    ->label(false) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'phone')
                    ->textInput(['maxlength' => true,'value'=>$params['phone'],
                        'placeholder'=>Yii::t('app','Phone')])
                    ->label(false)?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'address')
                    ->textInput(['maxlength' => true,'value'=>$params['address'],
                        'placeholder'=>Yii::t('app','Address')])
                    ->label(false)
                ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'facebook_id')
                    ->textInput(['maxlength' => true,'value'=>$params['facebook_id'],
                        'placeholder'=>Yii::t('app','Facebook_Id')])
                    ->label(false) ?>
            </div>
        </div>
   
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'adminEmail')
                    ->textInput(['maxlength' => true,'value'=>$params['adminEmail'],
                        'placeholder'=>Yii::t('app','AdminEmail')])
                    ->label(false) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'sanpchat_id')
                    ->textInput(['maxlength' => true,'value'=>$params['sanpchat_id'],
                        'placeholder'=>Yii::t('app','Sanpchat_Id')])
                    ->label(false) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'sanpchat_email')
                    ->textInput(['maxlength' => true,'value'=>$params['sanpchat_email'],
                        'placeholder'=>Yii::t('app','Sanpchat_Email')])
                    ->label(false) ?>
            </div>
            <div class="col-md-2"> <?= $form->field($model, 'tiktok_id')
                    ->textInput(['maxlength' => true,'value'=>$params['tiktok_id'],
                        'placeholder'=>Yii::t('app','Tiktok_Id')])
                    ->label(false) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'company_delivery')->widget(Select2::classname(), [
                    'data' =>  ArrayHelper::map(CompanyDelivery::find()->all(), 'id', 'name'),
                    'language' => 'ar',
                    'options' => ['value' =>$params['company_delivery']
                    ,'placeholder'=>Yii::t('app','Company_Delivery')]

                ])->label(false) ?>
            
            </div>
        </div>

        <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'massage_whatsapp')
                        ->textarea(['rows'=>"18","cols"=>"30",'placeholder'=>$placeholder_massage_whatsapp,
                        'value'=>$params['massage_whatsapp']])->label(false)
                    ?>

                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/png','placeholder'=>Yii::t('app','Logo')],
                        'pluginOptions' => $dataThumbnail
                    ])->label(false);
                    ?>

                </div>
            </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
