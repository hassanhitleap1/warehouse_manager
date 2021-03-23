<?php

use app\models\products\Products;
use app\models\regions\Regions;
use kartik\select2\Select2;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$regions_model=Regions::find()->all();
$regions=[];
foreach($regions_model as $key => $value){
    $regions[$value->id]=$value->name_ar ." ( ".$value->price_delivery ." )"; 
}

$this->title = $model->name;

?>

<div class="container" >
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <?= Html::img($model->thumbnail,['class'=>'thumbnail responsive-img','width'=>'100','height'=>'500'])?>
            </div>
        </div>
    <div class="row">
        <?php foreach($model->imagesProduct as $img):?>
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <?= Html::img($img->path,['class'=>'thumbnail responsive-img','width'=>'100','height'=>'500'])?>
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
                <div class="form-group">
                    <label for="type"><?=Yii::t('app','Choose_Type')?></label>
                    <select name="OrderForm[type]" class="form-control" id="type">
                        <?php foreach ($model->subProductCount as $subProductCount):?>
                            <option value="<?=$model->id?>"><?=$subProductCount->type?> </option>
                        <?php endforeach;?>

                    </select>
                </div>
          
        <?php else:?>
            <input type="hidden" name="OrderForm[type]"  value="<?=$model->subProductCount[0]->id?>"/>
        <?php endif;?>

        <?php if($model->type_options==Products::TYPE_CHOOSE_BOX):?>
            <label for="typeoption"><?=Yii::t('app','Choose_Offer')?></label>
            <?php foreach ($model->typeOptions as $type_option):?>
                <div class="radio">
                    <label><input type="radio" name="OrderForm[typeoption]" checked value="<?=$type_option->id?>"><?=$type_option->text?></label>
                </div>
            <?php endforeach;?>
           
        <?php else:?>
            <div class="form-group">
                <label for="typeoption"><?=Yii::t('app','Choose_Offer')?></label>
                <select class="form-control" name="OrderForm[typeoption]" id="typeoption">
                    <?php foreach ($model->typeOptions as $type_option):?>
                        <option value="<?=$type_option->id?>"><?=$type_option->text?> (<?=$type_option->price?> )</option>
                    <?php endforeach;?>
                      
                </select>
            </div>
           
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

  