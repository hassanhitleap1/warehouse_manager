<?php

use app\models\categorises\Categorises;
use app\models\companydelivery\CompanyDelivery;
use app\models\products\Products;
use app\models\suppliers\Suppliers;
use app\models\units\Units;
use app\models\warehouse\Warehouse;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;

/* @var $this yii\web\View */
/* @var $model app\models\products\Products */
/* @var $form yii\widgets\ActiveForm */



$dataImages = [];
$images_path_product= [];



if (!$model->isNewRecord) {
    foreach ($model->imagesProduct as $key => $value) {
        $images_path_product[] = Yii::getAlias('@web') . '/' . $value['path'];
    }



    $dataImages = [
        
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false,
        'initialPreview' => $images_path_product,
        'initialPreviewAsData' => true,
        'initialCaption' => Yii::getAlias('@web') . '/' . $model->thumbnail,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial'=>true

    ];

}else{

    $dataImages = [
        
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ];
}


?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="container">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        
    <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'purchasing_price')->textInput() ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'selling_price')->textInput() ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'video_url')->textInput() ?>
            </div>
            <div class="col-md-2">
            <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Categorises::find()->all(), 'id', 'name_ar'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
            </div>
            <div class="col-md-2">
            <?= $form->field($model, 'warehouse_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Warehouse::find()->all(), 'id', 'name'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>  
            </div>
    </div>
    <div class="row">
            <div class="col-md-3">
            <?= $form->field($model, 'type_options')->dropDownList([Products::TYPE_DROP_DAWNLIST=>"dropdown list",Products::TYPE_CHOOSE_BOX=>"choose box"]) ?>
            </div>
            <div class="col-md-3">
            <?= $form->field($model, 'supplier_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Suppliers::find()->all(), 'id', 'name'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
            </div>
            <div class="col-md-2">
            <?= $form->field($model, 'quantity')->textInput(['id'=>'quantity']) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'unit_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Units::find()->all(), 'id', 'name_en'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'company_delivery_id')->widget(Select2::classname(), [
                    'data' =>  ArrayHelper::map(CompanyDelivery::find()->all(), 'id', 'name'),
                    'language' => 'ar',
                    'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                ]); ?>
            </div>
    </div>

    <div class="row">
            <div class="col-md-6">
                <?php include('type_options.php') ?>
            </div>
            <div class="col-md-6">
            <?php include('sub_product_count.php') ?>
            </div>   
    </div>
  
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'description')->widget(Summernote::class, [
                        'options' => ['placeholder' => 'Edit your blog content here...']
                    ]);?>
            </div>
        </div>
        <div class="row " style="margin-top: 10px" >
            <div class="col-md-12" >

            <?= $form->field($model, 'images_product[]')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'multiple' => true],
                'pluginOptions' => $dataImages
            ]);
            ?>
        </div>
        </div>

   
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





