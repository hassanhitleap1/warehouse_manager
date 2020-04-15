<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


NavBar::begin([
    //'brandLabel' => Html::img('@web/images/logo.svg'),
    // 'brandLabel' => Yii::$app->name ,
    'brandLabel' => '<div>' . Yii::$app->name . Html::img('@web/images/logo.png', ['class' => 'logo']) . '</div>',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

include "menuItems.php";

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