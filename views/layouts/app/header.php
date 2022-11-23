    <?php

    use app\models\User;

    ?>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">


            <?php if (Yii::$app->user->isGuest) : ?>
                <div class="offcanvas__links">
                    <?= \yii\helpers\Html::a(Yii::t('app', 'Sign in'), ['site/login']) ?>
                </div>
            <?php else : ?>
                <div class="offcanvas__links">
                    <?= \yii\helpers\Html::beginForm(['/site/logout'], 'post') ?>
                    <?= \yii\helpers\Html::submitButton(Yii::t('app', 'logout')) ?>
                    <?= \yii\helpers\Html::endForm() ?>
                </div>
                <?php if (Yii::$app->user->identity->type == User::SUPER_ADMIN) : ?>
                    <div class="offcanvas__links">
                        <?= \yii\helpers\Html::a(Yii::t('app', 'dashboard'), ['dashboard/index']) ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>





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

            <!-- <div class="price">$0.00</div> -->
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p><?= Yii::t('app', 'Free shipping, IF order more then 80 JOD') ?></p>
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
                            <p><?= Yii::t('app', 'Free shipping, IF order more then 80 JOD') ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">

                            <?php if (Yii::$app->user->isGuest) : ?>
                                <div class="header__top__links">
                                    <?= \yii\helpers\Html::a(Yii::t('app', 'Sign in'), ['site/login']) ?>
                                </div>
                            <?php else : ?>
                                <div class="header__top__links">
                                    <?= \yii\helpers\Html::beginForm(['/site/logout'], 'post') ?>
                                    <?= \yii\helpers\Html::submitButton(Yii::t('app', 'logout')) ?>
                                    <?= \yii\helpers\Html::endForm() ?>
                                </div>
                                <?php if (Yii::$app->user->identity->type == User::SUPER_ADMIN) : ?>
                                    <div class="header__top__links">
                                        <?= \yii\helpers\Html::a(Yii::t('app', Yii::t('app', 'dashboard')), ['dashboard/index']) ?>
                                    </div>
                                <?php endif; ?>



                            <?php endif; ?>

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
                        <?= \yii\helpers\Html::a(
                            \yii\helpers\Html::img('/images/logo.png'),
                            ['site/index']
                        ) ?>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="<?= Yii::$app->controller->route == 'site/index' ? 'active' : '' ?>" class="active"><?= \yii\helpers\Html::a(Yii::t('app', 'Home'), ['site/index']) ?></li>
                            <li class="<?= Yii::$app->controller->route == 'site/shop' ? 'active' : '' ?>"><?= \yii\helpers\Html::a(Yii::t('app', 'Shop Now'), ['site/shop']) ?></li>
                            <li class="<?= Yii::$app->controller->route == 'site/contact' ? 'active' : '' ?>"><?= \yii\helpers\Html::a(Yii::t('app', 'Contacts'), ['site/contact']) ?></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="<?= Yii::getAlias('@web') . "/malefashion-master" ?>/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="img/icon/heart.png" alt=""></a>
                        <!-- <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a> -->
                        <!-- <div class="price">$0.00</div> -->
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->