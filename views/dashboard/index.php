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
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row" >

            <div class="col-md-4">
                <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/sales'?>'">
                    <?= Html::img("/images/icons/sales", ['style' => 'width:100%']) ?>
                    <h1><?= Yii::t('app','The_Sales') ?></h1>
                    <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['dashboard/sales'], ['class' => 'btn  btn-green']); ?></p>
                </div>
            </div>
        <div class="col-md-4">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/outlay'?>'">
                <?= Html::img("/images/icons/outlay", ['style' => 'width:100%']) ?>
                <h1><?= Yii::t('app','The_Sales') ?></h1>
                <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['dashboard/outlay'], ['class' => 'btn  btn-green']); ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/new-product'?>'">
                <?= Html::img("/images/icons/new-product", ['style' => 'width:100%']) ?>
                <h1><?= Yii::t('app','The_Sales') ?></h1>
                <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['dashboard/new-product'], ['class' => 'btn  btn-green']); ?></p>
            </div>
        </div>

            <div class="col-md-4">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/orders'?>'">
                <?= Html::img("/images/icons/orders", ['style' => 'width:100%']) ?>
                <h1><?= Yii::t('app','The_Sales') ?></h1>
                <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['dashboard/orders'], ['class' => 'btn  btn-green']); ?></p>
            </div>
        </div>
    </div>
</div>
