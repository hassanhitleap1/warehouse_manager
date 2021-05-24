<?php

use app\models\products\Products;
use app\models\regions\Regions;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$regions_model = Regions::find()->all();
$regions = [];
foreach ($regions_model as $key => $value) {
    $regions[$value->id] = $value->name_ar . " ".Yii::t('app','Delivery_Price')." ( " . $value->price_delivery . " )";
}
$this->title = $model->name;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.0/viewer.min.js" integrity="sha512-0goo56vbVLOJt9J6TMouBm2uE+iPssyO+70sdrT+J5Xbb5LsdYs31Mvj4+LntfPuV+VlK0jcvcinWQG5Hs3pOg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.0/viewer.css" integrity="sha512-HHYZlJVYgHVdz/pMWo63/ya7zc22sdXeqtNzv4Oz76V3gh7R+xPqbjNUp/NRmf0R85J++Yg6R0Kkmz+TGYHz8g==" crossorigin="anonymous" />

<div class="card-single">
    <div class="container-fliud">
        <div class="wrapper row">
            <div class="preview col-md-6">
                <div class="preview-pic tab-content">

                    <div class="swiper-container mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <?= Html::img($model->thumbnail, ['data-original' => $model->thumbnail]) ?>
                            </div>
                            <?php foreach ($model->imagesProduct as $key => $img) : ?>
                                <div class="swiper-slide">
                                    <?= Html::img($img->path, ['data-original' => $img->path]) ?>
                                </div>
                            <?php endforeach; ?>


                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                </div>

            </div>
            <div class="details col-md-6">
                <h5 class="product-title"><?= $this->title ?></h5>
            </div>
        </div>
        <div class="wrapper row" style="margin-top: 10px;">
            <div class="col-md-12">
                <p> <strong style="color:red;"><?=Yii::t('app','Delivery_Price_Added')?> </strong> </p>
            </div>
        </div>
        <div class="wrapper row">
            <div class="preview col-md-12">
                <?php  $form = ActiveForm::begin([
                'action' => ['products/fast-order'],
                'options' => [
                'class' => 'fast-order-form'
                ]
                ]);
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($modelOrder, 'name')->textInput(['maxlength' => true, 'required' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($modelOrder, 'phone')->textInput(['required' => true,'placeholder' => "07xxxxxxxx"]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($modelOrder, 'other_phone')->textInput(['placeholder' => "07xxxxxxxx"]) ?>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <?= $form->field($modelOrder, 'address')->textInput(['required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($modelOrder, 'region_id')->widget(Select2::classname(), [
                            'data' =>  $regions,
                            'language' => 'ar',

                        ]); ?>

                    </div>
                </div>


                <div class="row">
                    <?php if (count($model->subProductCount) >= 2 ) : ?>
                        <div class="col-md-6">
                            <?= $form->field($modelOrder, 'type')->dropDownList(ArrayHelper::map($model->subProductCount, 'id', 'type')) ?>
                        </div>
                    <?php else : ?>
                        <?= $form->field($modelOrder, 'type')->hiddenInput(['value' => $model->subProductCount[0]->id])->label(false); ?>
                    <?php endif; ?>

                    <div class="col-md-6">
                        <?php if ($model->type_options == Products::TYPE_CHOOSE_BOX) : ?>
                            <?php
                            $typeOptions= ArrayHelper::map($model->typeOptions, 'id', 'text');
                            $modelOrder->typeoption = array_key_first($typeOptions);;
                            ?>
                            <?= $form->field($modelOrder, 'typeoption')->radioList($typeOptions, ['style' => 'display: grid;']) ?>
                        <?php else : ?>
                            <?= $form->field($modelOrder, 'typeoption')->dropDownList(ArrayHelper::map($model->typeOptions, 'id', 'text')) ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Order_Now') . ' <span class="glyphicon glyphicon-shopping-cart"> </span>', ['class' => 'btn btn-green btn-lg btn-block', 'id' => 'send_order']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>




            </div>
        </div>


    </div>
</div>


