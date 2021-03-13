<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
<?php
        $menuItemsleft=[];
        $menuItems=[];

        NavBar::begin([
            //'brandLabel' => Html::img('@web/images/logo.svg'),
            'brandLabel' => Yii::$app->name ,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        if (Yii::$app->user->isGuest) {
            $menuItemsleft[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
       
        } else {
            $menuItems[] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/site/dashboard']];
            $menuItems[] = [
                'label' =>Yii::t('app', 'Countries') ,
                'items' => [
                    ['label' => Yii::t('app', 'Countries'), 'url' => ['/countries/index']],
                    ['label' => Yii::t('app', 'Regions'), 'url' => ['/regions/index']],
                    ['label' => Yii::t('app', 'Area'), 'url' => ['/area/index']],
                   
                ],
            ];

            $menuItems[] = [
                'label' =>Yii::t('app', 'Additional') ,
                'items' => [
                    ['label' => Yii::t('app', 'Categorises'), 'url' => ['/categorises/index']],
                    ['label' => Yii::t('app', 'Units'), 'url' => ['/units/index']],
                    ['label' => Yii::t('app', 'Status'), 'url' => ['/status/index']],
                    ['label' => Yii::t('app', 'Warehouse'), 'url' => ['/warehouse/index']],
                 
                ],
            ];

            $menuItems[] = [
                'label' =>Yii::t('app', 'Users') ,
                'items' => [
                    ['label' => Yii::t('app', 'Suppliers'), 'url' => ['/suppliers/index']],
                    ['label' => Yii::t('app', 'Users'), 'url' => ['/users/index']],
                 
                ],
            ];

            $menuItems[] = [
                'label' =>Yii::t('app', 'Products') ,
                'items' => [
                    ['label' => Yii::t('app', 'Products'), 'url' => ['/products/index']],
                    ['label' => Yii::t('app', 'SubProductCount'), 'url' => ['/sub-product-count/index']],
                 
                ],
            ];

           
            $menuItems[] = ['label' => Yii::t('app', 'Orders'), 'url' => ['/orders/index']];

            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '( ' . Yii::t('app', 'Logout') . ' ' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItemsleft,
        ]);
        NavBar::end();
        ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
