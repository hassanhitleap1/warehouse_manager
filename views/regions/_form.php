<?php

use app\models\countries\Countries;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\regions\Regions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_delivery')->textInput() ?>


    <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Countries::find()->all(), 'id', 'name_ar'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>

  




<?php
/*
$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    console.log("repo",repo)
    if (repo.loading) {
        return repo.text;
    }
    var markup =
        '<div class="row">' + 
            '<div class="col-sm-12">' +
                '<b style="margin-left:5px">'+ repo.arabicName + '</b>' + 
            '</div>' +
        '</div>';
return markup;

};
var formatRepoSelection = function (repo) {
    console.log("repo",repo)
    return repo.arabicName ;
}
JS;

// Register the formatting script
$this->registerJs($formatJs, View::POS_HEAD);

// script to parse the results into the format expected by Select2
$resultsJs = <<< JS
function (data, params) {
    params.page = params.page || 1;
    return {
        results: data.items
    };
}
JS;
// render your widget
echo Select2::widget([
    'name' => 'region',
    'value' => null,
    'initValueText' => 'kartik-v/yii2-widgets',
    'options' => ['placeholder' => 'Search for a repo ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 1,
        'ajax' => [
            'url' => Url::toRoute(["regions/get-regions"]) ,
            'dataType' => 'json',
            'delay' => 250,
            'data' => new JsExpression('function(params) { return {search:params.term, page: params.page}; }'),
            'processResults' => new JsExpression($resultsJs),
            'cache' => true
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('formatRepo'),
        'templateSelection' => new JsExpression('formatRepoSelection'),
    ],
]);
*/

?>


<div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    

</div>
