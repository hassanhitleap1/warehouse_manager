<?php

use yii\bootstrap\Html;

$this->title = 'home';
?>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="<?= Yii::getAlias('@web') . "/malefashion-master" ?>/img/hero/hero-1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6> <?= Yii::t('app', 'best price') ?></h6>
                            <h2> <?= Yii::t('app', 'Get the best deals from') ?> <?= Yii::$app->params['name_of_store'] ?> </h2>

                            <?= \yii\helpers\Html::a(
                                Yii::t('app', 'Shop Now') . ' <span class="arrow_right"></span>',
                                ['site/shop'],
                                ['class' => 'primary-btn']
                            ) ?>
                            <!-- <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="<?= Yii::getAlias('@web') . "/malefashion-master" ?>/img/hero/hero-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6> <?= Yii::t('app', 'best price') ?></h6>
                            <h2> <?= Yii::t('app', 'Get the best deals from') ?> <?= Yii::$app->params['name_of_store'] ?> </h2>
                            <?= \yii\helpers\Html::a(
                                Yii::t('app', 'Shop Now') . ' <span class="arrow_right"></span>',
                                ['site/shop'],
                                ['class' => 'primary-btn']
                            ) ?>


                            <!-- <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->



<!-- Product Section Begin -->
<section class="product spad">
    <h1 class="text-center"><?= Yii::t('app', 'Products') ?></h1>
    <hr />
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">

                    <li class="active" data-filter=".new-arrivals"><?= Yii::t('app', 'New Arrivals') ?></li>

                </ul>
            </div>
        </div>
        <div class="row product__filter">


            <?php foreach ($models as $model) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <?= $this->render('/components/product', ['model' => $model]); ?>
                </div>
            <?php endforeach; ?>









        </div>
    </div>
</section>
<!-- Product Section End -->