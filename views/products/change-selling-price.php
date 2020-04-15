<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.0/viewer.min.js" integrity="sha512-0goo56vbVLOJt9J6TMouBm2uE+iPssyO+70sdrT+J5Xbb5LsdYs31Mvj4+LntfPuV+VlK0jcvcinWQG5Hs3pOg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.0/viewer.css" integrity="sha512-HHYZlJVYgHVdz/pMWo63/ya7zc22sdXeqtNzv4Oz76V3gh7R+xPqbjNUp/NRmf0R85J++Yg6R0Kkmz+TGYHz8g==" crossorigin="anonymous" />

<div class="card-single">
    <div class="container-fliud">
       <h1><?= $model->name?> <?=$model->id?></h1>
       <div class="row"><div class="alert alert-danger" id="div_errors" style="display: none;"></div></div>
        <div class="wrapper row">
            <div class="preview col-md-12">
                <?php  $form = ActiveForm::begin([
                'action' => ['products/change-selling-price' ],
                'options' => [
                'class' => 'fast-order-form',
                'att_id'=>$model->id
                ]
                ]);
                ?>

                <?= $form->field($model, 'selling_price')->textInput() ?>

                <div class="row">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Save') . ' <span class="glyphicon glyphicon-shopping-cart"> </span>', ['class' => 'btn btn-green btn-lg btn-block', 'id' => 'save_model']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>


    </div>
</div>


