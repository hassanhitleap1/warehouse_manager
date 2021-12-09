<?php

use app\models\pricecompanydelivery\PriceCompanyDelivery;
use app\models\products\Products;
use app\models\regions\Regions;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$regions_model = Regions::find()->all();
$regions = [];
if(is_null($model->company_delivery_id)){

    foreach ($regions_model as $key => $value) {
        $regions[$value->id] = $value->name_ar . " ".Yii::t('app','Delivery_Price')." ( " . $value->price_delivery . " )";
    }

}else{

    $price_company_delivery=PriceCompanyDelivery::find()
        ->select(['regions.*','price_company_delivery.*'])
        ->leftJoin('regions', 'regions.id=price_company_delivery.region_id')
        ->where(['=','price_company_delivery.company_delivery_id',$model->company_delivery_id])->asArray()->all();
    foreach ($price_company_delivery as $key => $value) {
        $regions[$value['region_id']] = $value['name_ar'] . " ".Yii::t('app','Delivery_Price')." ( " . $value['price'] . " )";

    }

}


$this->title = $model->name;
?>

<div class="container">
        <div class="row no-gutters">
            <div class="col-md-5 pr-2">
                <div class="card">
                    <div class="demo">
                        <ul class="list-image-sider" id="lightSlider">
                            <li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src="https://i.imgur.com/KZpuufK.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src="https://i.imgur.com/KZpuufK.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src="https://i.imgur.com/KZpuufK.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
                            <li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-2">
                    <h6><?php Yii::t('app','Reviews')?></h6>
                    <div class="d-flex flex-row">
                        <div class="stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="ml-1 font-weight-bold">4.6</span>
                    </div>
                    <div class="mt-3">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?= str_replace('watch?v=', 'embed/', $model->video_url) ?>" allowfullscreen></iframe>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-7">
                <div class="card">

                    <div class="about">
                        <span class="font-weight-bold">
                            <h1><?= $model->name?></h1>
                        </span>
                    </div>

                    <hr>
                    <div class="product-description">
                        <?php  print $model->description?>
                    </div>
                    <div class="mb-2">
                        <p> <strong style="color:red;"><?=Yii::t('app','Delivery_Price_Added')?> </strong> </p>
                    </div>
                    <div class="form-put">
                        <div class="wrapper row">
                            <div class="preview col-md-12">
                                <?php $form = ActiveForm::begin(['id' => "order_landig"]); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $form->field($modelOrder, 'name')->textInput(['maxlength' => true, 'required' => true]) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($modelOrder, 'other_phone')->textInput(['placeholder' => "07xxxxxxxx"]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($modelOrder, 'phone')->textInput(['required' => true,'placeholder' => "07xxxxxxxx"]) ?>
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
                                            <?= $form->field($modelOrder, 'typeoption')->radioList($typeOptions) ?>
                                        <?php else : ?>
                                            <?= $form->field($modelOrder, 'typeoption')->dropDownList(ArrayHelper::map($model->typeOptions, 'id', 'text')) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="buttons">
                                    <div class="form-group">
                                        <button class="btn btn-light wishlist"> <i class="fa fa-heart"></i> </button>
                                        <?= Html::submitButton(Yii::t('app', 'Order_Now') . ' <span class="fas fa-shopping-cart"></span> ', ['class' => 'btn btn-outline-warning btn-long cart', 'id' => 'send_order','data-loading-text'=>"Loading..."]) ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                    </div>

                </div>



                <div class="card mt-2"> <span>Similar items:</span>
                    <div class="similar-products mt-2 d-flex flex-row">
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img src="https://i.imgur.com/KZpuufK.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$1,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img src="https://i.imgur.com/GwiUmQA.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$1,699</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img src="https://i.imgur.com/c9uUysL.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$2,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img src="https://i.imgur.com/kYWqL7k.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$3,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;"> <img src="https://i.imgur.com/DhKkTrG.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$999</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
<script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
<script>
    $('#lightSlider').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 9
    });
</script>