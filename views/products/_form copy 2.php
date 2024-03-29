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
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js" defer></script>

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
            <?= $form->field($model, 'discount')->textInput() ?>
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
      
    </div>
    <div class="row">
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
 
    </div>



    <div class="row">
        <div class="col-md-3">
        <?= $form->field($model, 'company_delivery_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(CompanyDelivery::find()->all(), 'id', 'name'),
                'language' => 'ar',
                'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
            ]); ?>
        </div>
    </div>
    

        <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'featured')
                ->checkBox(['data-size'=>'small', 'class'=>'bs_switch',
                'style'=>'margin-bottom:4px;', 'id'=>'featured']) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'top_selling')
            ->checkBox(['data-size'=>'small', 'class'=>'bs_switch control-label',
                'style'=>'margin-bottom:4px;', 'id'=>'top_selling']) ?>
        </div>

<div class="col-md-2">
            <?=$form->field($model, 'days')->textInput([
                                 'type' => 'number',
                                 'min'=>1,'max'=>60,
                                 'placeholder'=>Yii::t('app','days')
                            ])->label(false)?>
        </div>

        <div class="col-md-2">
        <?=$form->field($model, 'hours')->textInput([
                                 'type' => 'number',
                                 'min'=>1,'max'=>60,
                                 'placeholder'=>Yii::t('app','hours')
                            ])->label(false)?>
        </div>

        <div class="col-md-2">
                                        
           <?=$form->field($model, 'muints')->textInput([
                                 'type' => 'number',
                                 'min'=>1,'max'=>60,
                                 'placeholder'=>Yii::t('app','muints')
                            ])->label(false)?>
        </div>

        <div class="col-md-2">

        <?=$form->field($model, 'second')->textInput([
                                 'type' => 'number',
                                 'min'=>1,'max'=>60,
                                 'placeholder'=>Yii::t('app','second')
                            ])->label(false)?>
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
            <?= $form->field($model, 'description')->textarea(['id' => 'summernote']) ?>
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

<script>

    $(document).ready(function() {
        $('#summernote').summernote({
            lang: 'fr-FR', // <= nobody is perfect :)
            height: 300,
            toolbar : [
                ['style',['bold','italic','underline','clear']],
                ['font',['fontsize']],
                ['color',['color']],
                ['para',['ul','ol','paragraph']],
                ['link',['link']],
                ['picture',['picture']]
            ],
            callbacks : {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            }
        });
    });




    function uploadImage(image) {
        var data = new FormData();
        data.append("image",image);
        $.ajax ({
            data: data,
            type: "POST",
            url: `${SITE_URL}/index.php?r=medialibrary/upload`,
            // returns a chain containing the path
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {

                var image = document.location.origin + url;
                setTimeout(function(){
                    $('#summernote').summernote("insertImage", image);
                }, 500);

            },
            error: function(data) {
                console.log(data);
            }
        });
    }


</script>





