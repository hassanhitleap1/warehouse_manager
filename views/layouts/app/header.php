    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">

                <?php if (Yii::$app->user->isGuest) : ?>
                    <?= \yii\helpers\Html::a('Sign in', ['site/login']) ?>
                <?php else : ?>

                    <?= \yii\helpers\Html::beginForm(['/site/logout'], 'post') ?>
                    <?= \yii\helpers\Html::a('logout', ['site/login']) ?>
                    <?= \yii\helpers\Html::endForm() ?>
                <?php endif; ?>


                <a href="#"></a>

            </div>
            <div class="offcanvas__top__hover">
                <span>JOD <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>JOD</li>

                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="<?= Yii::getAlias('@web') . "/malefashion-master" ?>/img/icon/search.png" alt=""></a>
            <a href="#"><img src="<?= Yii::getAlias('@web') . "/malefashion-master" ?>/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="<?= Yii::getAlias('@web') . "/malefashion-master" ?>/img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, IF order more then 80 JOD.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, IF order more then 80 JOD.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <?php if (Yii::$app->user->isGuest) : ?>
                                    <?= \yii\helpers\Html::a('Sign in', ['site/login']) ?>
                                <?php else : ?>
                                    <?= \yii\helpers\Html::beginForm(['/site/logout'], 'post') ?>
                                    <?= \yii\helpers\Html::a('logout', ['site/login']) ?>
                                    <?= \yii\helpers\Html::endForm() ?>
                                <?php endif; ?>
                            </div>
                            <div class="header__top__hover">
                                <span>JOD <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>JOD</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="<?= Yii::getAlias('@web') . "/malefashion-master" ?>/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><?= \yii\helpers\Html::a('Home', ['site/index']) ?></li>
                            <li><?= \yii\helpers\Html::a('Shop', ['site/shop']) ?></li>
                            <li><?= \yii\helpers\Html::a('Contacts', ['site/contacts']) ?></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="<?= Yii::getAlias('@web') . "/malefashion-master" ?>/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="img/icon/heart.png" alt=""></a>
                        <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                        <div class="price">$0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->