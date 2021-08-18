<?php

// use app\models\area\Area;
use app\models\companydelivery\CompanyDelivery;
// use app\models\countries\Countries;
use app\models\orders\Orders;
use app\models\regions\Regions;
use app\models\status\Status;
use Carbon\Carbon;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use kartik\date\DatePicker;
// use kartik\time\TimePicker;

$delivery_price=0;
$name=null;
$phone=null;
$other_phone=null;
$address=null;
$discount=0;


if (!$model->isNewRecord) {
    $delivery_price=$model->delivery_price;
    $user=$model->user;
    $name=$user->name;
    $phone=$user->phone;
    $other_phone=$user->other_phone;
    $address=$user->address;
    $discount=$model->discount;

}
/* @var $this yii\web\View */
/* @var $model app\models\orders\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div >

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-3">
            
            <?= $form->field($model, 'name')->textInput(['value'=>$name ,"autocomplete"=>"off"]) ?>
         
            <?= $form->field($model, 'phone')->textInput(['value'=>$phone ,"autocomplete"=>"no-fill"]) ?>
            <?= $form->field($model, 'other_phone')->textInput(['value'=>$other_phone,"autocomplete"=>"no-fill" ,"autocomplete"=>"false"]) ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true,['value'=>$address ,"autocomplete"=>"off"]]) ?>


            <?= $form->field($model, 'region_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(Regions::find()->all(), 'id', 'name_ar'),
                'language' => 'ar',
                'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'id'=>'region_id'],
            ]); ?>
 
            <?= $form->field($model, 'company_delivery_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(CompanyDelivery::find()->all(), 'id', 'name'),
                'language' => 'ar',
                'options' => ['placeholder' =>Yii::t('app',"Plz_Select"),'id'=>'company_delivery_id'],
            ]); ?>
        </div>
        <div class="col-md-6">
            <div class="row">
                <?php include('order_items.php') ?>
            </div>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'discount')->textInput(['id'=>'discount','value' => $discount]) ?>
            <?= $form->field($model, 'delivery_price')->textInput(['id'=>'delivery_price','value'=>$delivery_price]) ?>
            <?= $form->field($model, 'amount_required')->textInput(['id'=>'amount_required']) ?>
            <?= $form->field($model, 'total_price')->textInput(['id'=>'total_price']) ?>
           
            <?= $form->field($model, 'profit_margin')->hiddenInput(['id'=>'profit_margin'])->label(false); ?>
            <?= $form->field($model, 'note')->textarea(['rows' => '6']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ["id"=>"submitform",'class' => 'btn btn-success','data-loading-text'=>"Loading..."]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script  type="text/javascript">


$( document ).ready(function() {
    
    $(document).on('click','#submitform',function (e) {
          e.preventDefault();
          var $btn = $(this);
       
            $btn.button('loading');

            $('#submitform').attr('disabled','disabled');
            $("#dynamic-form").submit();
            setTimeout(function(){ 
                var form = $("#dynamic-form");
                if(form.find('.has-error').length) {
                    hide_loader();
                    $('#submitform').prop('disabled',false);
                    $btn.button('reset');
                    return false;

                }else{
                    show_loader();
                    $('#submitform').prop('disabled',true);
                    $btn.button('reset');
                }
            
            }, 
            1000);
            
        });
    
});  


$(document).on('focus','input',function (event) {
    if(!$(this).attr("data-krajee-touchspin")){
        $(this).css({"box-sizing":"border-box","z-index":10000000,"width":"200%",'position':"relative"});
    }
});
$(document).on('focusout','input',function (event) {
    $(this).removeAttr("style");
});

</script>