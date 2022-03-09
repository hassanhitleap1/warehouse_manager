<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::$app->name;
$path_theme= Yii::getAlias('@web').'theme/shop/'

?>
<main>
    <div id="carousel-home" class="add_top_5">
        <div class="owl-carousel owl-theme">
            <?php  foreach( $sliders as $slider  ):?>
                <div class="owl-slide cover" style="background-image: url(<?=$path_theme?>img/slides/slide_home_2.jpg);">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-end">
                            <div class="col-lg-6 static">
                                <div class="slide-text text-right white">
                                    <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Max 720 Sage Low</h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        Limited items available at this price
                                    </p>
                                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <?php endforeach;?>  
            
            
        </div>
        <div id="icon_drag_mobile"></div>
    </div>
    <!--/carousel-->

    <ul id="banners_grid" class="clearfix">
        <?php foreach($bansers  as  $key => $banser):?>
            <li>
            <a href="<?= $banser->link ?>" class="img_container">
                <img src="<?= $path_theme ?>img/banners_cat_placeholder.jpg"  data-src="<?= $path_theme ?>img/banner_1.jpg" alt="" class="lazy">
                <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <h3><?= $banser->title?> </h3>
                    <div><span class="btn_1"><?=Yii::t('app','Shop Now')?></span></div>
                </div>
            </a>
        </li>
         <?php endforeach; ?>   
 
    </ul>
    <!--/banners_grid -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2> <?= Yii::t('app','Top Selling') ;?> </h2>
            <span><?= Yii::t('app','Products') ;?> </span>
        </div>
        <div class="row small-gutters">

            <?php foreach ($models as  $key => $model) : ?>
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="grid_item">
                        <span class="ribbon hot"><?=Yii::t('app','Hot')?></span>
                        <figure>
                            <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$model->id]) ?>">
                                <?= Html::img($model->thumbnail , ['data-src'=>$model->thumbnail,'class'=>'img-fluid lazy'])?>
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$model->id]) ?>">
                            <h3><?= $model->name?></h3>
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
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            <?php endforeach;?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->


    <!-- /featured -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2><?= Yii::t('app','Featured') ;?></h2>
            <span> <?= Yii::t('app','Products') ;?> </span>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            <?php foreach ($models as  $key => $model) : ?>
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new"><?=Yii::t('app','New')?></span>
                        <figure>
                            <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$model->id]) ?>">
                                <?= Html::img($model->thumbnail , ['data-src'=>$model->thumbnail,'class'=>'owl-lazy'])?>
                               
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
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            <?php endforeach;?>
        
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->



</main>