<?php


$this->title = $model->name;

use app\models\pricecompanydelivery\PriceCompanyDelivery;
use app\models\products\Products;
use app\models\regions\Regions;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$regions_model = Regions::find()->all();
$regions = [];
if (is_null($model->company_delivery_id)) {

    foreach ($regions_model as $key => $value) {
        $regions[$value->id] = $value->name_ar . " " . Yii::t('app', 'Delivery_Price') . " ( " . $value->price_delivery . " )";
    }
} else {

    $price_company_delivery = PriceCompanyDelivery::find()
        ->select(['regions.*', 'price_company_delivery.*'])
        ->leftJoin('regions', 'regions.id=price_company_delivery.region_id')
        ->where(['=', 'price_company_delivery.company_delivery_id', $model->company_delivery_id])->asArray()->all();
    foreach ($price_company_delivery as $key => $value) {
        $regions[$value['region_id']] = $value['name_ar'] . " " . Yii::t('app', 'Delivery_Price') . " ( " . $value['price'] . " )";
    }
}
$path_theme = Yii::getAlias('@web') . 'theme/shop/'

?>
<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <?= Html::a(Yii::t('app', 'Home'), ['site/index']) ?>
                        <?= Html::a(Yii::t('app', 'Shop'), ['site/shop']) ?>

                        <span>Product Details</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach ($model->imagesProduct as $key => $img) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $key == 0 ? "active" : "" ?>" data-toggle="tab" href="#tabs-<?= $key ?>" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="<?= Yii::getAlias('@web') . $img->path ?>">
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <?php foreach ($model->imagesProduct as $key => $img) : ?>
                            <div class="tab-pane <?= $key == 0 ? "active" : '' ?>" id="tabs-<?= $key ?>" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="<?= Yii::getAlias('@web') . $img->path ?>" alt="">
                                </div>
                            </div>
                        <?php endforeach; ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4><?= $model->name ?></h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <span> - 5 Reviews</span>
                        </div>
                        <h3> <?= $model->purchasing_price ?> JOD</h3>
                        <p> <?php print  $model->description ?></p>
                        <?php $uri  =  Url::to(['product/view', 'id' => $model->id]); ?>

                        <form id='order_landig' action="<?= $uri ?> " method='post'>
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

                            <div class="col-12 ">
                                <div class="form-group field-orderform-name required">
                                    <input type="text" id="orderform-name" class="form-control" placeholder="الأسم" name="OrderForm[name]" value="<?= isset($_POST['OrderForm']['name']) ? $_POST['OrderForm']['name'] : '' ?>" aria-required="true">
                                    <?php if ($modelOrder->hasErrors("name")) : ?>
                                        <div class="help-block"><?= $modelOrder->getErrors("name")[0] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group field-orderform-phone required has-error">
                                        <label class="control-label" for="orderform-phone">هاتف </label>
                                        <input type="text" id="orderform-phone" class="form-control" name="OrderForm[phone]" placeholder="07xxxxxxxx" value="<?= isset($_POST['OrderForm']['phone']) ? $_POST['OrderForm']['phone'] : '' ?>" aria-required="true" aria-invalid="true">
                                        <?php if ($modelOrder->hasErrors("phone")) : ?>
                                            <div class="help-block"><?= $modelOrder->getErrors("phone")[0] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group field-orderform-other_phone">
                                        <label class="control-label" for="orderform-other_phone">هاتف اخر</label>
                                        <input type="text" id="orderform-other_phone" class="form-control" name="OrderForm[other_phone]" value="<?= isset($_POST['OrderForm']['other_phone']) ? $_POST['OrderForm']['other_phone'] : '' ?>" placeholder="07xxxxxxxx">
                                        <?php if ($modelOrder->hasErrors("other_phone")) : ?>
                                            <div class="help-block"><?= $modelOrder->getErrors("other_phone")[0] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group field-orderform-address required has-error">
                                        <label class="control-label" for="orderform-address">العنوان</label>
                                        <input type="text" id="orderform-address" class="form-control" name="OrderForm[address]" value="<?= isset($_POST['OrderForm']['address']) ? $_POST['OrderForm']['address'] : '' ?>" aria-required="true" aria-invalid="true">
                                        <?php if ($modelOrder->hasErrors("address")) : ?>
                                            <div class="help-block"><?= $modelOrder->getErrors("address")[0] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group field-orderform-region_id">
                                        <label class="control-label" for="orderform-region_id">المحافظة</label>
                                        <select id="orderform-region_id" class="form-control" name="OrderForm[region_id]">
                                            <?php foreach ($regions as $key => $region) : ?>
                                                <option value="<?= $key ?>" <?= isset($_POST['OrderForm']['region_id']) && $_POST['OrderForm']['region_id'] == $key ? 'selected' : '' ?>><?= $region ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <?php if ($modelOrder->hasErrors("region_id")) : ?>
                                            <div class="help-block"><?= $modelOrder->getErrors("region_id")[0] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <?php if (count($model->subProductCount) >= 2) : ?>
                                    <div class="col-md-6">

                                        <div class="form-group field-orderform-type">
                                            <label class="control-label" for="orderform-region_id">النوع</label>
                                            <select id="orderform-type" class="form-control" name="OrderForm[type]">
                                                <?php foreach ($model->subProductCoun as $key => $subProductCoun) : ?>
                                                    <option value="<?= $subProductCoun->id ?>" <?= isset($_POST['OrderForm']['type']) && $_POST['OrderForm']['type'] == $subProductCoun->id ? 'selected' : '' ?>><?= $subProductCoun->text ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php if ($modelOrder->hasErrors("type")) : ?>
                                                <div class="help-block"><?= $modelOrder->getErrors("type")[0] ?></div>
                                            <?php endif; ?>
                                        </div>


                                    </div>
                                <?php else : ?>
                                    <input type="hidden" name="OrderForm[type]" value="<?= $model->subProductCount[0]->id ?>">

                                <?php endif; ?>

                                <div class="col-md-6">
                                    <?php if ($model->type_options == Products::TYPE_CHOOSE_BOX) : ?>

                                        <div class="form-group field-orderform-typeoption">
                                            <label class="control-label" for="orderform-typeoption">النوع</label>
                                            <select id="orderform-typeoption" class="form-control" name="OrderForm[typeoption]">
                                                <?php foreach ($model->typeOptions as $key => $typeOptions) : ?>
                                                    <option value="<?= $typeOptions->id ?>" <?= isset($_POST['OrderForm']['typeoption']) && $_POST['OrderForm']['typeoption'] == $typeOptions->id ? 'selected' : '' ?>><?= $typeOptions->text ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php if ($modelOrder->hasErrors("typeoption")) : ?>
                                                <div class="help-block"><?= $modelOrder->getErrors("typeoption")[0] ?></div>
                                            <?php endif; ?>
                                        </div>





                                    <?php else : ?>





                                        <div class="form-group field-orderform-typeoption">
                                            <label class="control-label" for="orderform-typeoption">النوع</label>
                                            <select id="orderform-typeoption" class="form-control" name="OrderForm[typeoption]">
                                                <?php foreach ($model->typeOptions as $key => $typeOptions) : ?>
                                                    <option value="<?= $typeOptions->id ?>" <?= isset($_POST['OrderForm']['typeoption']) && $_POST['OrderForm']['typeoption'] == $typeOptions->id ? 'selected' : '' ?>><?= $typeOptions->text ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php if ($modelOrder->hasErrors("typeoption")) : ?>
                                                <div class="help-block"><?= $modelOrder->getErrors("typeoption")[0] ?></div>
                                            <?php endif; ?>
                                        </div>



                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">

                                <?= Html::submitButton(

                                    Yii::t('app', 'Order_Now'),
                                    ['class' => 'primary-btn  cart', 'id' => 'send_order', 'data-loading-text' => "Loading..."]
                                ) ?>
                            </div>


                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Product</h3>
            </div>
        </div>
        <div class="row">
            <?php if (count($model->upsell)) : ?>
                <?php foreach ($model->upsell as $key => $upsell) : ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?= Yii::getAlias('@web') . "/" . $upsell->thumbnail ?>">
                                <ul class="product__hover">
                                    <!-- <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                            </li>
                                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li> -->
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><?= $upsell->name ?></h6>

                                <?= Html::a(Yii::t('app', 'Update'), ['/product/view', 'id' => $upsell->id], ['class' => 'add-cart']) ?>

                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5><?= $upsell->purchasing_price ?> JOD</h5>
                                <div class="product__color__select">
                                    <!-- <label for="pc-4">
                                                <input type="radio" id="pc-4">
                                            </label>
                                            <label class="active black" for="pc-5">
                                                <input type="radio" id="pc-5">
                                            </label>
                                            <label class="grey" for="pc-6">
                                                <input type="radio" id="pc-6">
                                            </label> -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($product_suggested as $key => $product) : ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?= Yii::getAlias('@web') . "/" . $product->thumbnail ?>">
                                <ul class="product__hover">
                                    <!-- <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                            </li>
                                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li> -->
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><?= $product->name ?></h6>

                                <?= Html::a(Yii::t('app', 'Update'), ['/product/view', 'id' => $product->id], ['class' => 'add-cart']) ?>

                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5><?= $product->purchasing_price ?> JOD</h5>
                                <div class="product__color__select">
                                    <!-- <label for="pc-4">
                                                <input type="radio" id="pc-4">
                                            </label>
                                            <label class="active black" for="pc-5">
                                                <input type="radio" id="pc-5">
                                            </label>
                                            <label class="grey" for="pc-6">
                                                <input type="radio" id="pc-6">
                                            </label> -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
</section>
<!-- Related Section End -->