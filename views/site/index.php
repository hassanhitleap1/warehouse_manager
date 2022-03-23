<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = Yii::$app->name;
$path_theme= Yii::getAlias('@webroot').'theme/shop/';

?>
<main>

    <?= $this->render('@app/views/components/slider', ['sliders' => $sliders]); ?>
    <!--/carousel-->



    <?= $this->render('@app/views/components/bansers', ['bansers' => $bansers]); ?>

    <!--/banners_grid -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2> <?= Yii::t('app','Top Selling') ;?> </h2>
            <span><?= Yii::t('app','Products') ;?> </span>
        </div>
        <div class="row small-gutters">

            <?php foreach ($models as  $key => $top_sell) : ?>

                <?= $this->render('@app/views/components/product_card', ['model' => $top_sell]); ?>

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

        <?= $this->render('@app/views/components/carousel_products', ['models' => $models]); ?>


        <!-- /products_carousel -->
    </div>
    <!-- /container -->


</main>