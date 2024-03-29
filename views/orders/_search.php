<?php

use app\models\products\Products;
use kartik\daterange\DateRangePicker;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$products=ArrayHelper::map(Products::find()->orderBy(['id' => SORT_DESC])->all(), 'id', 'name');

/* @var $this yii\web\View */
/* @var $model app\models\orders\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

        <div class="row" style="margin:10px">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                        'data-pjax' => 1
                    ],
                ]); ?>

            <div class="col-md-4">
                <label class="control-label"><?=Yii::t('app','Created_At')?></label>
                <?= DateRangePicker::widget([
                    'model'=>$model,
                    'language' => 'en',
                    'attribute'=>'created_at',
                    'readonly'=>true,
                    'convertFormat'=>true,
                    'options' => ['class' => 'form-control' ,"autocomplete"=>"off" ,"autocomplete"=>"no-fill"],
                    'pluginOptions'=>[
                        'timePicker'=>true,
                        'timePickerIncrement'=>30,
                        'locale'=>[
                            'format'=>'Y-m-d'
                        ]
                    ]
                ]);

                ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'search_string') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model,"products_id")->widget(Select2::classname(), [
                    'data' => $products,
                    'language' => 'ar',
                    'options' => ['multiple' => true,'placeholder' =>Yii::t('app',"Plz_Select"),'class'=>'product_id'],

                ]); ?>

            </div>

            <div class="col-md-1" style="margin-top: 27px;">
            
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary search_order']) ?>
                    <?= Html::a(Yii::t('app', 'Reset'), ['/orders'],['class' => 'btn btn-outline-secondary']) ?>
                </div>

            </div>
  

  

    <?php ActiveForm::end(); ?>

    
    </div>



  
</div>
