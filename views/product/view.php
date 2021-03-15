<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = $model->name;
?>

<div class="container">
        <?= Html::img($model->thumbnail,['class'=>'thumbnail','width'=>'100','height'=>'400'])?>
    <?php foreach($model->imagesProduct as $img):?>
        <?= Html::img($img->path,['width'=>'300','height'=>'200'])?>
    <?php endforeach;?>

    <?php if(!is_null($model->video_url)):?>
        <iframe width="500" height="350" src="<?= str_replace('watch?v=','embed/',$model->video_url)?>">  </iframe>
    <?php endif;?>
    <!-- https://www.youtube.com/watch?v=JLiOmeU3s-E -->

    <div class="row">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelOrder, 'name')->textInput(['maxlength' => true]) ?> 
        <?= $form->field($modelOrder, 'phone')->textInput([]) ?> 
        <?= $form->field($modelOrder, 'other_phone')->textInput([]) ?> 
        <?= $form->field($modelOrder, 'address')->textInput([]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
    
</div>
