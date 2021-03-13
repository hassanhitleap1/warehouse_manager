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
$name=null;
$phone=null;
$other_phone=null;
$address=null;
$name_in_facebook=null;
$delivery_date=date("Y-m-d", strtotime('tomorrow'));
if (!$model->isNewRecord) {
    $order_id=$model->order_id;
    $delivery_price=$model->delivery_price;
    $user=$model->user;
    $name=$user->name;
    $phone=$user->phone;
    $other_phone=$user->other_phone;
    $address=$user->address;
    $name_in_facebook=$user->name_in_facebook;
    $delivery_date=$model->delivery_date;
}
/* @var $this yii\web\View */
/* @var $model app\models\orders\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'order_id')->textInput(['value'=>$order_id]) ?>
            <?= $form->field($model, 'name')->textInput(['value'=>$name]) ?>
            <?= $form->field($model, 'name_in_facebook')->textInput(['value'=>$name]) ?>
            <?= $form->field($model, 'phone')->textInput(['value'=>$phone]) ?>
            <?= $form->field($model, 'other_phone')->textInput(['value'=>$other_phone]) ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true,['value'=>$address]]) ?>
            <?= $form->field($model, 'delivery_date')->widget(DatePicker::classname(), [
                'options' => ['value' => $delivery_date],
                'value' => $delivery_date,

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
               

            ]); ?>
            <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Countries::find()->all(), 'id', 'name_ar'),
                'language' => 'ar',
                

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
            <?= $form->field($model, 'profit_margin')->textInput(['id'=>'profit_margin']) ?>
            <?= $form->field($model, 'note')->textarea(['rows' => '6']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script  type="text/javascript">

$( document ).ready(function() {
    // $( "#orders-order_id" ).prop( "disabled", true );
    // $( "#profit_margin" ).prop( "disabled", true );
    
});

</script>