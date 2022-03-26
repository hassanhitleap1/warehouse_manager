<div class="container margin_60_35">
    <div class="main_title">
        <h2>Related</h2>
        <span>Products</span>

    </div>
    <div class="owl-carousel owl-theme products_carousel">
        <?php if(count($model->upsell )):?>
            <?php foreach ($model->upsell as $key => $upsell):?>
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon hot"><?=Yii::t('app','Hot')?></span>
                        <figure>
                            <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$upsell->id]) ?>">
                                <?= \yii\helpers\Html::img($upsell->thumbnail , ['data-src'=>$upsell->thumbnail,'class'=>'img-fluid lazy'])?>
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$upsell->id]) ?>">
                            <h3><?= $upsell->name?></h3>
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
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span><?= Yii::t('app','Add to favorites')?></span></a></li>
                            <li><a href="#0" class="tooltip-1 add_to_cart"
                                   att_price="<?=$upsell->selling_price ?>"  att_thumbnail="<?=$upsell->thumbnail?>"
                                   att_product_id="<?=$upsell->id?>"    att_discount="<?=$upsell->discount?>"  att_name="<?= $upsell->name?>"
                                   data-toggle="tooltip" data-placement="left" title="Add to cart">
                                    <i class="ti-shopping-cart"></i><span><?= Yii::t('app','Add to cart')?></span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            <?php endforeach;?>
        <?php else:?>
            <?php foreach ($product_suggested as $key => $product):?>
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon hot"><?=Yii::t('app','Hot')?></span>
                        <figure>
                            <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$product->id]) ?>">
                                <?= \yii\helpers\Html::img($product->thumbnail , ['data-src'=>$product->thumbnail,'class'=>'img-fluid lazy'])?>
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$product->id]) ?>">
                            <h3><?= $product->name?></h3>
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
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span><?= Yii::t('app','Add to favorites')?></span></a></li>
                            <li><a href="#0" class="tooltip-1 add_to_cart"
                                   att_price="<?=$product->selling_price ?>"  att_thumbnail="<?=$product->thumbnail?>"
                                   att_product_id="<?=$product->id?>"    att_discount="<?=$product->discount?>"  att_name="<?= $product->name?>"
                                   data-toggle="tooltip" data-placement="left" title="Add to cart">
                                    <i class="ti-shopping-cart"></i><span><?= Yii::t('app','Add to cart')?></span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            <?php endforeach;?>
        <?php endif;?>

    </div>
    <!-- /products_carousel -->
</div>