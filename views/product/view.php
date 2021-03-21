<?php

use app\models\products\Products;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = $model->name;
?>

<div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <?= Html::img($model->thumbnail,['class'=>'thumbnail responsive-img','width'=>'100','height'=>'500'])?>
            </div>
        </div>
    <div class="row">
        <?php foreach($model->imagesProduct as $img):?>
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <?= Html::img($img->path,['width'=>'300','height'=>'200'])?>
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

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelOrder, 'name')->textInput(['maxlength' => true ,'required'=>true]) ?>
        <?= $form->field($modelOrder, 'phone')->textInput(['required'=>true]) ?>
        <?= $form->field($modelOrder, 'other_phone')->textInput([]) ?>
        <?= $form->field($modelOrder, 'address')->textInput(['required'=>true]) ?>
        <?php if($model->type_options==Products::TYPE_CHOOSE_BOX):?>
            <?php foreach ($model->typeOptions as $type_option):?>
                <div class="radio">
                    <label><input type="radio" name="optradio" checked value="<?=$type_option->text?>"><?=$type_option->text?></label>
                </div>
            <?php endforeach;?>
            <?php foreach ($model->typeOptions as $type_option):?>
                <div class="radio">
                    <label><input type="radio" name="optradio" checked value="<?=$type_option->text?>"><?=$type_option->text?></label>
                </div>
            <?php endforeach;?>
        
        <?php endif;?>
        <?php if($model->type_options==Products::TYPE_DROP_DAWNLIST):?>
            <div class="form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" id="usr">
            </div>
        <?php endif;?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Order_Now') .' <span class="glyphicon glyphicon-shopping-cart"> </span>', ['class' => 'btn btn-green btn-lg btn-block']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
    
</div>
