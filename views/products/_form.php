<?php

use app\models\categorises\Categorises;
use app\models\status\Status;
use app\models\suppliers\Suppliers;
use app\models\units\Units;
use app\models\warehouse\Warehouse;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\products\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'purchasing_price')->textInput() ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'selling_price')->textInput() ?>
        </div>
        <div class="col-md-3">
         <?= $form->field($model, 'quantity')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            
            <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Categorises::find()->all(), 'id', 'name_ar'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>

        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'warehouse_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Warehouse::find()->all(), 'id', 'name_en'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'supplier_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Suppliers::find()->all(), 'id', 'name'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'unit_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Units::find()->all(), 'id', 'name_en'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
        </div>
    </div>    
    
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'thumbnail')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
        
      
        </div>
    </div>   


   

   


    



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
