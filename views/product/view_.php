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
<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li>Page active</li>
                </ul>
            </div>
            <h1>Armor Air X Fear</h1>
        </div>
        <!-- /page_header -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="owl-carousel owl-theme prod_pics magnific-gallery">
                    <?php foreach ($model->imagesProduct as $key => $img) : ?>

                        <div class="item">
                            <a href="<?= $img->thumbnail?>" title="Photo title" data-effect="mfp-zoom-in">
                                <?= Html::img($img->path) ?>
                            </a>
                        </div>
                    <?php endforeach; ?>


                </div>
                <!-- /carousel -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="bg_white">
        <div class="container margin_60_35">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="prod_info version_2">
                        <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i><em>4 reviews</em></span>
                        <p><small>SKU: MTKRY-001</small><br>
                        <p>
                            <?php  print $model->description?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="prod_options version_2">

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


                        <div class="form-group">

                            <?= Html::submitButton(
                                '<span class="spinner spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>'.
                                Yii::t('app', 'Order_Now') . ' <span class="fas fa-shopping-cart"></span> ', ['class' => 'btn_1  cart', 'id' => 'send_order','data-loading-text'=>"Loading..."]) ?>
                        </div>
                        <?php ActiveForm::end(); ?>



                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /bg_white -->

    <div class="tabs_product bg_white version_2">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Description</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
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
                                Description
                            </a>
                        </h5>
                    </div>

                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <h3>Details</h3>
                                    <p>Lorem ipsum dolor sit amet, in eleifend <strong>inimicus elaboraret</strong> his, harum efficiendi mel ne. Sale percipit vituperata ex mel, sea ne essent aeterno sanctus, nam ea laoreet civibus electram. Ea vis eius explicari. Quot iuvaret ad has.</p>
                                    <p>Vis ei ipsum conclusionemque. Te enim suscipit recusabo mea, ne vis mazim aliquando, everti insolens at sit. Cu vel modo unum quaestio, in vide dicta has. Ut his laudem explicari adversarium, nisl <strong>laboramus hendrerit</strong> te his, alia lobortis vis ea.</p>
                                    <p>Perfecto eleifend sea no, cu audire voluptatibus eam. An alii praesent sit, nobis numquam principes ea eos, cu autem constituto suscipiantur eam. Ex graeci elaboraret pro. Mei te omnis tantas, nobis viderer vivendo ex has.</p>
                                </div>
                                <div class="col-lg-5">
                                    <h3>Specifications</h3>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <tbody>
                                            <tr>
                                                <td><strong>Color</strong></td>
                                                <td>Blue, Purple</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Size</strong></td>
                                                <td>150x100x100</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Weight</strong></td>
                                                <td>0.6kg</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Manifacturer</strong></td>
                                                <td>Manifacturer</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /TAB A -->
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                                Reviews
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-5">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>5.0/5.0</em></span>
                                            <em>Published 54 minutes ago</em>
                                        </div>
                                        <h4>"Commpletely satisfied"</h4>
                                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><em>4.0/5.0</em></span>
                                            <em>Published 1 day ago</em>
                                        </div>
                                        <h4>"Always the best"</h4>
                                        <p>Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row justify-content-between">
                                <div class="col-lg-5">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><em>4.5/5.0</em></span>
                                            <em>Published 3 days ago</em>
                                        </div>
                                        <h4>"Outstanding"</h4>
                                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>5.0/5.0</em></span>
                                            <em>Published 4 days ago</em>
                                        </div>
                                        <h4>"Excellent"</h4>
                                        <p>Sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <p class="text-right"><a href="leave-review.html" class="btn_1">Leave a review</a></p>
                        </div>
                        <!-- /card-body -->
                    </div>

                </div>
                <!-- /tab B -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <div class="bg_white">
        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Related</h2>
                <span>Products</span>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                <?php if(count($model->upsell )):?>
                    <?php foreach ($model->upsell as $key => $upsell):?>
                        <div class="item">
                            <div class="grid_item">
                                <span class="ribbon new">New</span>
                                <figure>
                                    <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$upsell->id]) ?>">
                                        <?= Html::img($upsell->thumbnail , ['data-src'=>$upsell->thumbnail,'class'=>'owl-lazy'])?>
                                    </a>
                                </figure>
                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$upsell->id]) ?>">
                                    <h3><?= $upsell->name?> </h3>
                                </a>
                                <div class="price_box">
                                    <?php if(!is_null($upsell->discount)):?>
                                        <span class="new_price"><?= $upsell->selling_price - $upsell->discount ?>  JD</span>
                                        <span class="old_price"><?= $upsell->selling_price  ?>  JD</span>

                                    <?php else:?>
                                        <span class="new_price"><?= $upsell->selling_price?> JD</span>
                                    <?php endif;?>
                                </div>
                                <ul>
                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                </ul>
                            </div>
                            <!-- /grid_item -->
                        </div>
                    <?php endforeach;?>
                <?php else:?>
                <?php foreach ($product_suggested as $key => $product):?>
                        <div class="item">
                            <div class="grid_item">
                                <span class="ribbon new">New</span>
                                <figure>
                                    <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$product->id]) ?>">
                                        <?= Html::img($product->thumbnail , ['data-src'=>$product->thumbnail,'class'=>'owl-lazy'])?>
                                    </a>
                                </figure>
                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$product->id]) ?>">
                                    <h3>ACG React Terra</h3>
                                </a>
                                <div class="price_box">
                                    <?php if(!is_null($product->discount)):?>
                                        <span class="new_price"><?= $product->selling_price - $product->discount ?>  JD</span>
                                        <span class="old_price"><?= $product->selling_price  ?>  JD</span>

                                    <?php else:?>
                                        <span class="new_price"><?= $product->selling_price?> JD</span>
                                    <?php endif;?>
                                </div>
                                <ul>
                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                </ul>
                            </div>
                            <!-- /grid_item -->
                        </div>
                <?php endforeach;?>
                <?php endif;?>


            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_white -->

</main>