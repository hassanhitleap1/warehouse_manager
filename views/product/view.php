<?php

use app\models\products\Products;
use app\models\regions\Regions;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$regions_model=Regions::find()->all();
$regions=[];
foreach($regions_model as $key => $value){
    $regions[$value->id]=$value->name_ar ." ( ".$value->price_delivery ." )"; 
}

$this->title = $model->name;

?>

<script type="javascript">
    Swal.fire(
        <?= '  dsds'; ?>,
        <?= 'ddsd' ?>,
        'success'
    );
</script>

<?php if (Yii::$app->session->has('message')) : ?>
    <script type="javascript">
        Swal.fire(
            <?= Yii::$app->session->get('message'); ?>,
            <?= Yii::$app->session->get('message'); ?>,
            'success'
        );
    </script>


    <?php Yii::$app->session->remove('message'); ?>
<?php endif; ?>


<div class="container" >
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
               
                <?= Html::img('/'.$model->thumbnail,['class'=>'thumbnail responsive-img','width'=>'100','height'=>'500'])?>
            </div>
        </div>
    <div class="row">
        <?php foreach($model->imagesProduct as $img):?>
            
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <?= Html::img('/'.$img->path,['class'=>'thumbnail responsive-img','width'=>'100','height'=>'500'])?>
            </div>
        <?php endforeach;?>
    </div>


    <?php if(!is_null($model->video_url) && $model->video_url !="" ):?>
    <div class="row">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?= str_replace('watch?v=','embed/',$model->video_url)?>" allowfullscreen></iframe>
        </div>
    </div>
    <?php endif;?>

    <div class="row form-order " style="margin-top: 10px">

        <?php $form = ActiveForm::begin(['id'=>"order_landig"]); ?>

        <?= $form->field($modelOrder, 'name')->textInput(['maxlength' => true ,'required'=>true]) ?>
        <?= $form->field($modelOrder, 'phone')->textInput(['required'=>true]) ?>
        <?= $form->field($modelOrder, 'other_phone')->textInput([]) ?>
   
        <?= $form->field($modelOrder, 'region_id')->widget(Select2::classname(), [
                'data' =>$regions,  
                'language' => 'en',
             

            ]); ?>
      

        <?php if($model->subProductCount > 1):?>

            <?= $form->field($modelOrder, 'type')->dropDownList(ArrayHelper::map($model->subProductCount,'id','type')) ?>

        <?php else:?>
           <?= $form->field($model, 'type')->hiddenInput(['value'=> $model->subProductCount[0]->id])->label(false);?>
          
        <?php endif;?>

        <?php if($model->type_options==Products::TYPE_CHOOSE_BOX):?>
            
            <?= $form->field($modelOrder, 'typeoption')->radioList(ArrayHelper::map($model->typeOptions,'id','text'),['style'=>'display: grid;'])?>  
            
        <?php else:?>
            
            
           
            <?= $form->field($modelOrder, 'typeoption')->dropDownList(ArrayHelper::map($model->typeOptions,'id','text')) ?>
        <?php endif;?>
        <div class="form-group ">
            <?= Html::submitButton(Yii::t('app', 'Order_Now') .' <span class="glyphicon glyphicon-shopping-cart"> </span>', ['class' => 'btn btn-green btn-lg btn-block','id'=>'send_order']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
  
   
        
</div>
<div class="row productmainbtn" style="display: block;">
    <div class="col-md-12">
        <a href="#" id="ordernow" class="btn btn-green btn-lg btn-block" style="width:100%"><i class="glyphicon glyphicon-shopping-cart"></i> <?=Yii::t('app', 'Order_Now')?> </a>
    </div>
</div>

   