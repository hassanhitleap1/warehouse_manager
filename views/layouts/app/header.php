<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<header class="version_2">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="<?= Url::to(['site/index']) ?>">
                            <?= Html::img('images/logo.png',['width'=>"100",'height'=>"35"])?>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="<?= Url::to(['site/index']) ?>">
                                <?= Html::img('images/logo.png',['width'=>"100",'height'=>"35"])?>

                            </a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>

                            <li>
                                <?= Html::a(Yii::t('app','Home'),['site/index']);?>

                            </li>

                            <li>
                                <?= Html::a(Yii::t('app','Shop_Now'),['site/shop']);?>

                            </li>



                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="<?= Url::to(['site/cart']) ?>" class="cart_bt"><strong id="dropdown-cart-number"><?= count(\Yii::$app->cart->getItems())?></strong></a>
                                <div class="dropdown-menu">
                                    <ul class="list_cart">
                                        <?php foreach (\Yii::$app->cart->getItems() as $cart ):?>
                                            <li>
                                                <a href="<?= Url::to(['product/view',['id'=>$cart->getProduct()->id]]) ?>">
                                                    <figure>
                                                        <?= \yii\helpers\Html::img($cart->getProduct()->thumbnail , ['data-src'=>$cart->getProduct()->thumbnail,'class'=>'lazy', 'width'=>"50" ,'height'=>"50"])?>
                                                    </figure>
                                                    <strong><span><?= $cart->getProduct()->name?> </span><?= $cart->getProduct()->selling_price?> Jd</strong>

                                                </a>
                                                <a href="#0" class="action"><i class="ti-trash"></i></a>
                                            </li>
                                        <?php endforeach;?>



                                    </ul>
                                    <div class="total_drop">
                                        <div class="clearfix"><strong><?= Yii::t('app','Total') ?></strong><span>$200.00</span></div>
                                        <a href="<?= Url::to(['site/cart']) ?>" class="btn_1 outline"><?= Yii::t('app','View Cart') ?></a><a href="checkout.html" class="btn_1"><?= Yii::t('app','Checkout') ?></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                            <a href="#0" class="wishlist"><span><?= Yii::t('app','Wishlist') ?></span></a>
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="account.html" class="access_link"><span>Account</span></a>
                                <div class="dropdown-menu">
                                    <?php if(Yii::$app->user->isGuest):?>
                                        <?= Html::a(Yii::t('app','Sign In or Sign Up') ,['site/login'],['class'=>'btn_1']) ?>
                                    <?php else:?>
                                        <?= Html::a(Yii::t('app','Dashboard') ,['dashboard/index'],['class'=>'btn_1']) ?>
                                    <?php endif;?>
                                    <?php if(!Yii::$app->user->isGuest):?>
                                        <ul>
                                            <li>
                                                <?= Html::a('<i class="ti-package"></i> '.Yii::t('app','My Orders') ,['dashboard/index']) ?>
                                            </li>
                                            <li>
                                                <?= Html::a('<i class="ti-user"></i>'.Yii::t('app','My Profile') ,['dashboard/index']) ?>
                                            </li>

                                        </ul>
                                    <?php endif;?>
                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="search_panel"><span>Search</span></a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->
</header>