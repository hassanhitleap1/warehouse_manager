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
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["count_order"]?>  عدد طلبات اليوم</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["total_sales"]?>  مبيعات اليوم</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["quantity"]?>  عدد القطع</div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["outlays"]?>  النفقات</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["profit_margin"] ?>    المرابح</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["profit_margin"] - $orders["outlays"]?>   صافي المرابح</div>
            </div>
        </div>

    </div>

    <div class="row" >
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= Yii::t('app','Name')?></th>
                <th scope="col"><?= Yii::t('app','Count')?></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($details as $key_det=> $detail):?>
                <tr>
                    <th scope="row"><?= ++$key_det ?></th>
                    <td><?= $detail['type'] ?> </td>
                    <td><?= $detail['sum_quantity'] ?></td>
                </tr>
            <?php endforeach;?>


            </tbody>
        </table>


    </div>
    <div class="row" >

            <div class="col-md-3">
                <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/sales'?>'">
                    <?= Html::img("images/icons/sales.svg", ['style' => 'width:100%']) ?>
                    <h1 style="padding: 12px;"><?= Yii::t('app','The_Sales') ?></h1>

                </div>
            </div>
        <div class="col-md-3">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/outlay'?>'">
                <?= Html::img("images/icons/outlay.svg", ['style' => 'width:100%']) ?>
                <h1 style="padding: 12px;"><?= Yii::t('app','The_Outlay') ?></h1>

            </div>
        </div>

        <div class="col-md-3">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/best-seller'?>'">
                <?= Html::img("images/icons/best-seller.svg", ['style' => 'width:100%']) ?>
                <h1 style="padding: 12px;"><?= Yii::t('app','Best_Seller') ?></h1>

            </div>
        </div>

            <div class="col-md-3">
            <div class="card" onclick="window.location.href = '<?= 'index.php?r=dashboard/orders'?>'">
                <?= Html::img("images/icons/order.svg", ['style' => 'width:100%']) ?>
                <h1 style="padding: 12px;" ><?= Yii::t('app','The_Orders') ?></h1>
            </div>
        </div>
    </div>
</div>
