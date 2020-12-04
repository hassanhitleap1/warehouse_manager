<?php

use app\models\categorises\Categorises;
use app\models\suppliers\Suppliers;
use app\models\units\Units;
use app\models\warehouse\Warehouse;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

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
        'initialPreview' => [
            Yii::getAlias('@web') . '/' . $model->thumbnail,
        ],
        'initialPreviewAsData' => true,
        'initialCaption' => Yii::getAlias('@web') . '/' . $model->thumbnail,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial' => false,

    ];


    $dataImages = [
        'initialPreview' => $images_path_product,
        'initialPreviewAsData' => true,
        'initialCaption' => Yii::getAlias('@web') . '/' . $model->thumbnail,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial' => false,

    ];

}


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
        <div class="col-md-3">
        <div class="row">
        <div class="padding-v-md">
            <div class="line line-dashed"></div>
        </div>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper_courses', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 15, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $subProductCounts[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'type',
                'count',
            ],
        ]); ?>


        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> <?= Yii::t('app', 'Courses') ?> <?= Yii::t('app', 'IF_Exist') ?>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items">
                <?php foreach ($subProductCounts as $index => $subProductCount): ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address"> <?= Yii::t('app', 'Courses') ?> : <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                                // necessary for update action.
                                if (!$subProductCount->isNewRecord) {
                                    echo Html::activeHiddenInput($subProductCount, "[{$index}]id");
                                }
                            ?>
            
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($subProductCount, "[{$index}]type")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($subProductCount, "[{$index}]count")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- end:row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>

    
    </div>


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
            <?= $form->field($model, 'thumbnail')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataThumbnail
            ]);
            ?>
        </div>
        <div class="col-md-3">
        
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





<?php
$js = '

jQuery(".dynamicform_wrapper_courses").on("afterInsert", function(e, item) {
jQuery(".dynamicform_wrapper_courses .panel-title-address").each(function(index) {
jQuery(this).html("' . Yii::t('app', 'Courses') . ': " + (index + 1))
});
});

jQuery(".dynamicform_wrapper_courses").on("afterDelete", function(e) {
jQuery(".dynamicform_wrapper_courses .panel-title-address").each(function(index) {
jQuery(this).html("' . Yii::t('app', 'Courses') . ': " + (index - 1))
});
});
';

$this->registerJs($js);
?>