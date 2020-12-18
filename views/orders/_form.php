<?php

use app\models\area\Area;
use app\models\countries\Countries;
use app\models\orders\Orders;
use app\models\regions\Regions;
use app\models\status\Status;
use Carbon\Carbon;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
$order_id = (string) Orders::find()->count() + 1 ;
$delivery_price=0;


if (!$model->isNewRecord) {
    $order_id=$model->order_id;
    $delivery_price=$model->delivery_price;
}
/* @var $this yii\web\View */
/* @var $model app\models\orders\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'order_id')->textInput(['value'=>$order_id,'disabled'=>true]) ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'phone')->textInput() ?>
            <?= $form->field($model, 'other_phone')->textInput() ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'delivery_date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'Enter_date')],
                'value' => Carbon::now('Asia/Amman')->toDateString(),

                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                // 'value'=>Carbon::now('Asia/Amman')->toDateString(),
                // 'pickerIcon' => '<i class=" text-primary"></i>',
                // 'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'autoclose' => false,
                    'format' => 'yyyy-mm-dd',


                ]
            ]); ?>
            <?= $form->field($model, 'delivery_time')->widget(TimePicker::classname(), []);?>
            <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Status::find()->all(), 'id', 'name_ar'),
                'language' => 'ar',
                'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'id'=>'status_id'],

            ]); ?>
            <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Countries::find()->all(), 'id', 'name_ar'),
                'language' => 'ar',
                'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'id'=>'country_id'],

            ]); ?>
            <?= $form->field($model, 'region_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Regions::find()->all(), 'id', 'name_ar'),
                'language' => 'ar',
                'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'id'=>'region_id'],

            ]); ?>
            <?= $form->field($model, 'area_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Area::find()->all(), 'id', 'name_ar'),
                'language' => 'ar',
                'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'id'=>'area_id'],

            ]); ?>
        </div>
        <div class="col-md-4">
            <div class="row">
                <?php include('order_items.php') ?>
            </div>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'discount')->textInput(['id'=>'discount','value' => 0]) ?>
            <?= $form->field($model, 'delivery_price')->textInput(['id'=>'delivery_price','value'=>$delivery_price]) ?>
            <?= $form->field($model, 'total_price')->textInput(['id'=>'total_price']) ?>
            <?= $form->field($model, 'amount_required')->textInput(['id'=>'amount_required']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

