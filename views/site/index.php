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
                            <h6>best price</h6>
                            <h2>Get the best deals from <?= Yii::$app->params['name_of_store'] ?> </h2>

                            <?= \yii\helpers\Html::a(
                                'Shop now <span class="arrow_right"></span>',
                                ['site/shop'],
                                ['class' => 'primary-btn']
                            ) ?>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
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
                            <h6>best price</h6>
                            <h2>Get the best deals from <?= Yii::$app->params['name_of_store'] ?> </h2>
                            <?= \yii\helpers\Html::a(
                                'Shop now <span class="arrow_right"></span>',
                                ['site/shop'],
                                ['class' => 'primary-btn']
                            ) ?>


                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
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
    <h1 class="text-center">products</h1>
    <hr />
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">

                    <li class="active" data-filter=".new-arrivals">New Arrivals</li>

                </ul>
            </div>
        </div>
        <div class="row product__filter">


            <?php foreach ($models as $model) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg=<?= Yii::getAlias('@web') . "/" . $model->thumbnail ?>>
                            <span class="label">New</span>
                            <ul class="product__hover">

                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Piqué Biker Jacket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$67.24</h5>
                            <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php foreach ($models as $model) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <?= $this->render('/components/product', ['model' => $model]); ?>
                </div>

            <?php endforeach; ?>

            <?php foreach ($models as $model) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?= Yii::getAlias('@web') . "/" . $model->thumbnail ?>">
                            <ul class="product__hover">
                                <!-- <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                            </li>
                                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li> -->
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><?= $model->name ?></h6>

                            <?= Html::a(Yii::t('app', 'Update'), ['/product/view', 'id' => $model->id], ['class' => 'add-cart']) ?>

                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5><?= $model->purchasing_price ?> JOD</h5>
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
            <?php foreach ($models as $model) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?= Yii::getAlias('@web') . "/" . $model->thumbnail ?>">
                            <ul class="product__hover">
                                <!-- <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                            </li>
                                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li> -->
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><?= $model->name ?></h6>

                            <?= Html::a(Yii::t('app', 'Update'), ['/product/view', 'id' => $model->id], ['class' => 'add-cart']) ?>

                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5><?= $model->purchasing_price ?> JOD</h5>
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







        </div>
    </div>
</section>
<!-- Product Section End -->