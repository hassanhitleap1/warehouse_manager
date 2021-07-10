<?php

use app\models\products\Products;
use app\models\TypeOutlay\TypeOutlay;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outlays\Outlays */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outlays-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'value')->textInput() ?>
    <?= $form->field($model,"type")->widget(Select2::classname(), [
                                            'data' =>ArrayHelper::map(TypeOutlay::find()->all(),'id','title' ),
                                            'language' => 'ar',
                                            'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'class'=>'product_id'],
                                        
                                        ]); ?>  

    
    <?= $form->field($model,"product_id")->widget(Select2::classname(), [
                                            'data' =>ArrayHelper::map(Products::find()->all(),'id','name' ),
                                            'language' => 'ar',
                                            'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'class'=>'product_id'],
                                        
                                        ]); ?>  
    



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
