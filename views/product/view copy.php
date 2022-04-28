<?php


$this->title = $model->name;
use app\models\pricecompanydelivery\PriceCompanyDelivery;
use app\models\products\Products;
use app\models\regions\Regions;
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
$path_theme = Yii::getAlias('@web') . 'theme/shop/'

?>




<link href="<?=$path_theme?>css/product_page.css" rel="stylesheet">

<main>
    <div class="container margin_30">
        <div class="countdown_inner">-20% This offer ends in <div data-countdown="2019/05/15" class="countdown"></div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="all">
                    <div class="slider">
                        <div class="owl-carousel owl-theme main">
                            <?php foreach ($model->imagesProduct as $key => $img) : ?>
                                <div style="background-image: url(<?= "/$img->path" ?>);" class="item-box"></div>
                            <?php endforeach; ?>
                            
                        </div>
                        <div class="left nonl"><i class="ti-angle-left"></i></div>
                        <div class="right"><i class="ti-angle-right"></i></div>
                    </div>
                    <div class="slider-two">
                        <div class="owl-carousel owl-theme thumbs">
                            <?php foreach ($model->imagesProduct as $key => $img) : ?>
                                <div style="background-image: url(<?= "'/$img->path'" ?>);" class="item <?= $key == 0 ? 'active':'' ?>"></div>
                            <?php endforeach; ?>


                        </div>
                        <div class="left-t nonl-t"></div>
                        <div class="right-t"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <!-- /page_header -->
                <div class="prod_info">
                    <h1> <?=$model->name;?></h1>

                    <p> <br>
                        <?php print  $model->description ?>
                    </p>
                    <div class="prod_options">
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

                                <?= $form->field($modelOrder, 'region_id')->dropDownList($regions) ?>

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


                        <div class="form-group">

                            <?= Html::submitButton(
                                '<span class="spinner spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>'.
                                Yii::t('app', 'Order_Now') . ' <span class="fas fa-shopping-cart"></span> ', ['class' => 'btn_1  cart', 'id' => 'send_order','data-loading-text'=>"Loading..."]) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>

                </div>
                <!-- /prod_info -->

            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab"> <?= Yii::t('app','Description') ?></a>
                </li>

            </ul>
        </div>
    </div>
    <!-- /tabs_product -->
    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">

                                <?= Yii::t('app','Description') ?>
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-12">
                                    <h3><?= Yii::t('app','Details') ?></h3>
                                    <p>   <?php print  $model->description ?> </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- /tab B -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <?= $this->render('@app/views/components/related', ['model' => $model,'product_suggested'=>$product_suggested]); ?>

    <!-- /container -->



</main>
