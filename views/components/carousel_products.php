<div class="owl-carousel owl-theme products_carousel">
    <?php foreach ($models as  $key => $model) : ?>

        <div class="item">
            <div class="grid_item">
                <span class="ribbon new"><?=Yii::t('app','New')?></span>
                <figure>
                    <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$model->id]) ?>">
                        <?= \yii\helpers\Html::img($model->thumbnail , ['data-src'=>$model->thumbnail,'class'=>'owl-lazy'])?>

                    </a>
                </figure>
                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$model->id]) ?>">
                    <h3><?=$model->name?></h3>
                </a>
                <div class="price_box">
                    <?php if(!is_null($model->discount)):?>
                        <span class="new_price"><?= $model->selling_price - $model->discount ?>  JD</span>
                        <span class="old_price"><?= $model->selling_price  ?>  JD</span>

                    <?php else:?>
                        <span class="new_price"><?= $model->selling_price?> JD</span>
                    <?php endif;?>
                </div>
                <ul>
                    <li><a href="#0"  class="tooltip-1 add-to-wishlist"   att_product_id="<?=$model->id?>"  data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span><?= Yii::t('app','Add to favorites')?></span></a></li>
                    <li><a href="#0" class="tooltip-1 add_to_cart"
                           att_price="<?=$model->selling_price ?>"  att_thumbnail="<?=$model->thumbnail?>"
                           att_product_id="<?=$model->id?>"    att_discount="<?=$model->discount?>"  att_name="<?= $model->name?>"
                           data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span><?= Yii::t('app','Add to cart')?></span></a></li>
                </ul>
            </div>
            <!-- /grid_item -->
        </div>
    <?php endforeach;?>

</div>