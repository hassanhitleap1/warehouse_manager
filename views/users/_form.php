<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\users\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'other_phone')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

  
    <div class="row">
       
        <div class="col-md-3">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'type')->dropDownList(
            [User::USER=>Yii::t("app",'User'),User::DATA_ENTERY=>Yii::t("app",'Data_Entry')],        
           
            ); ?>
        </div>
    </div>

    

    

    

   


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
