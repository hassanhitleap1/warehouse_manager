<?php

use app\models\User;
use yii\helpers\Html;

$menuItemsleft = [];
$menuItems = [];

if (Yii::$app->user->isGuest) {
    $menuItemsleft[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
}elseif(Yii::$app->user->identity->type == User::DATA_ENTERY){
    $menuItems[] = ['label' => Yii::t('app', 'Orders'), 'url' => ['/orders/index']];
    $menuItems[] = '<li>'
    . Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton(
        '( ' . Yii::t('app', 'Logout') . ' ' . Yii::$app->user->identity->username . ')',
        ['class' => 'btn btn-link logout']
    )
    . Html::endForm()
    . '</li>';
} else {

    $menuItems[] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/dashboard/index']];
    $menuItems[] = [
        'label' => Yii::t('app', 'Countries'),
        'items' => [
            ['label' => Yii::t('app', 'Countries'), 'url' => ['/countries/index']],
            ['label' => Yii::t('app', 'Regions'), 'url' => ['/regions/index']],
            ['label' => Yii::t('app', 'Area'), 'url' => ['/area/index']],

        ],
    ];

    $menuItems[] = [
        'label' => Yii::t('app', 'Additional'),
        'items' => [
            ['label' => Yii::t('app', 'Categorises'), 'url' => ['/categorises/index']],
            ['label' => Yii::t('app', 'Units'), 'url' => ['/units/index']],
            ['label' => Yii::t('app', 'Status'), 'url' => ['/status/index']],
            ['label' => Yii::t('app', 'Warehouse'), 'url' => ['/warehouse/index']],
            ['label' => Yii::t('app', 'Company_Delivery'), 'url' => ['/company-delivery/index']],
            ['label' => Yii::t('app', 'Price_Company_Delivery'), 'url' => ['/price-company-delivery/index']],
            ['label' => Yii::t('app', 'Settings'), 'url' => ['/settings/index']],
            ['label' => Yii::t('app', 'Change_Password'), 'url' => ['/change-password/index']],
            ['label' => Yii::t('app', 'Outlays'), 'url' => ['/outlays/index']],
            ['label' => Yii::t('app', 'Type_Outlay'), 'url' => ['/type-outlay/index']],





        ],
    ];

    $menuItems[] = [
        'label' => Yii::t('app', 'Users'),
        'items' => [
            ['label' => Yii::t('app', 'Suppliers'), 'url' => ['/suppliers/index']],
            ['label' => Yii::t('app', 'Users'), 'url' => ['/users/index']],

        ],
    ];

    $menuItems[] = [
        'label' => Yii::t('app', 'Products'),
        'items' => [
            ['label' => Yii::t('app', 'Products'), 'url' => ['/products/index']],
            ['label' => Yii::t('app', 'SubProductCount'), 'url' => ['/sub-product-count/index']],
            ['label' => Yii::t('app', 'Type_Options'), 'url' => ['/options-sell-product/index']],


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