<?php

use app\models\categorises\Categorises;
use app\models\products\Products;
use app\models\suppliers\Suppliers;
use app\models\units\Units;
use app\models\warehouse\Warehouse;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\products\Products */
/* @var $form yii\widgets\ActiveForm */


$dataThumbnail = [];
$dataImages = [];
$images_path_product= [];



if (!$model->isNewRecord) {
    foreach ($model->imagesProduct as $key => $value) {
        $images_path_product[] = Yii::getAlias('@web') . '/' . $value['path'];
    }

    
    $dataThumbnail = [
      

        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false,
        'initialPreview' => [
            Yii::getAlias('@web') . '/' . $model->thumbnail,
        ],
        'initialPreviewAsData' => false,
        'initialCaption' => Yii::getAlias('@web') . '/' . $model->thumbnail,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial'=>true
     

    ];


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
    $dataThumbnail = [
      
       
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ];
    $dataImages = [
        
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ];
}


?>

<div class="container">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'purchasing_price')->textInput() ?>
                <?= $form->field($model, 'selling_price')->textInput() ?>
                <?= $form->field($model, 'video_url')->textInput() ?>
                <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Categorises::find()->all(), 'id', 'name_ar'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
               <?= $form->field($model, 'description')->textarea(['rows' => '6']) ?>      
                <?= $form->field($model, 'type_options')->dropDownList([Products::TYPE_DROP_DAWNLIST=>"dropdown list",Products::TYPE_CHOOSE_BOX=>"choose box"]) ?>   
                <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataThumbnail
                    ]);
                ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'quantity')->textInput(['id'=>'quantity']) ?>
                <?= $form->field($model, 'warehouse_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Warehouse::find()->all(), 'id', 'name'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>  
                <?= $form->field($model, 'supplier_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Suppliers::find()->all(), 'id', 'name'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
                <?= $form->field($model, 'unit_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Units::find()->all(), 'id', 'name_en'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>    

            <?= $form->field($model, 'images_product[]')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*', 'multiple' => true],
                            'pluginOptions' => $dataImages
                        ]);
            ?>
            </div>
            
            <div class="col-md-4">
                <div class="row">
                    <?php include('sub_product_count.php') ?>
                </div>
                <div class="row">
                    <?php include('type_options.php') ?>
                </div>

            </div>
            
        </div>   

   
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





