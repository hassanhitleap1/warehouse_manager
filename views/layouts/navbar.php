<?php

use app\models\categorises\Categorises;
$categoris=Categorises::find()->all();
?>
<nav class="navbar  navbar-mainbg navbar-expand-sm mb-2 ">

    <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
    </button>
    <?= \yii\helpers\Html::a("<span class='mb-2'>".Yii::$app->name."<span/>".\yii\helpers\Html::img('@web/images/logo.png', ['class' => 'logo']), ['site/index'], ['class' => 'navbar-brand order-sm-2 order-1']) ?>

    <div class="navbar-collapse collapse order-2 order-sm-1 justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
            <?php if (Yii::$app->user->isGuest): ?>
                <li class="nav-item <?=  (Yii::$app->controller->route =='site/login')?'active':'' ?>">
                    <?= \yii\helpers\Html::a('<i class="fas fa-tachometer-alt"></i>'.Yii::t('app','Login') ,['site/login'], ['class' => 'nav-link']) ?>
                </li>
            <?php else:?>

                <li class="nav-item ">
                    <?= \yii\helpers\Html::beginForm(['/site/logout'], 'post')?>
                    <a class="nav-link logout"  href="#" > <i class="fas fa-tachometer-alt"></i> <?= Yii::t('app', 'Logout') ?></a>
                    <?=\yii\helpers\Html::endForm() ?>
                </li>

                <li class="nav-item ">
                    <?= \yii\helpers\Html::a('<i class="fas fa-tachometer-alt"></i>'.Yii::t('app','Dashboard') ,['dashboard/index'], ['class' => 'nav-link']) ?>
                </li>



            <?php endif;?>


            <?php foreach ($categoris as $key => $category) :?>
                <li class="nav-item  <?= Yii::$app->controller->route =='site/index' && isset($_GET['category']) && $category->id == $_GET['category'] ?'active':'' ?>"">
                <?= \yii\helpers\Html::a('<i class="fas fa-tachometer-alt"></i>'.$category->name_ar, ['site/index' , 'category'=>$category->id  ], ['class' => 'nav-link']) ?>
                </li>
            <?php endforeach;?>
            <li class="nav-item <?=Yii::$app->controller->route =='site/index' && !isset($_GET['category'])?'active':'' ?>">
                <?= \yii\helpers\Html::a('<i class="fas fa-tachometer-alt"></i>'.Yii::t('app','All') ,['site/index'], ['class' => 'nav-link']) ?>
            </li>


        </ul>
    </div>

</nav>
