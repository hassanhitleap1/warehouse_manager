<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app','Dashboard');
$this->params['breadcrumbs'][] = $this->title;


//$label_month;
// $label_day;
// $orders_count_month;
// $orders_count_day; 
// $profits_month;

?>
<div class="site-about">

    <div class="row" >

            <div class="col-md-4">
                <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/sales'?>'">
                    <?= Html::img("/images/icons/sales.svg", ['style' => 'width:100%']) ?>
                    <h1 style="padding: 12px;"><?= Yii::t('app','The_Sales') ?></h1>

                </div>
            </div>
        <div class="col-md-4">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/outlay'?>'">
                <?= Html::img("/images/icons/outlay.svg", ['style' => 'width:100%']) ?>
                <h1 style="padding: 12px;"><?= Yii::t('app','The_Outlay') ?></h1>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/best-seller'?>'">
                <?= Html::img("/images/icons/best-seller.svg", ['style' => 'width:100%']) ?>
                <h1 style="padding: 12px;"><?= Yii::t('app','Best_Seller') ?></h1>

            </div>
        </div>

            <div class="col-md-4">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/orders'?>'">
                <?= Html::img("/images/icons/order.svg", ['style' => 'width:100%']) ?>
                <h1 style="padding: 12px;" ><?= Yii::t('app','The_Orders') ?></h1>
            </div>
        </div>
    </div>
</div>
