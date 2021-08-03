<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app','Dashboard');
$this->params['breadcrumbs'][] = $this->title;


$label=[];
$data=[];

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <hr />

    <div class="row" >
        <div class="col-md-12">
            <h2><?= Yii::t('app','Number_Of_Grains')?></h2>
            <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= Yii::t('app','Name')?></th>
                <th scope="col"><?= Yii::t('app','Number_Of_Grains')?></th>

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
    </div>


    <hr />
    <div class="row" >
        <div class="col-md-12">
            <h2><?= Yii::t('app','Number_Of_Grains')?></h2>
            <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= Yii::t('app','Status')?></th>
                <th scope="col"><?= Yii::t('app','Count_Orders')?></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($status_orders as $key_stat => $status_order):?>
                <tr>
                    <th scope="row"><?= ++$key_stat ?></th>
                    <td><?= $status_order['name_ar'] ?> </td>
                    <td><?= $status_order['count_order'] ?></td>
                </tr>
            <?php endforeach;?>


            </tbody>
        </table>
        </div>

    </div>

    <hr />
    <div class="row" >
        <h2><?= Yii::t('app','Previous_Order_Statuses')?></h2>
        <div class="col-md-6">
            <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= Yii::t('app','Status')?></th>
                <th scope="col"><?= Yii::t('app','Count_Orders')?></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($status_statisticis as $key_stici => $status_statistici):?>
                <tr>
                    <th scope="row"><?= ++$key_stici ?></th>
                    <td><?= $status_statistici['name_ar'] ?> </td>
                    <td><?= $status_statistici['count_order'] ?></td>
                </tr>
                <?php

                $label[]=$status_statistici["name_ar"];
                $data[]=$status_statistici["count_order"];
                ?>
            <?php endforeach;?>


            </tbody>
        </table>
        </div>
        <div class="col-md-6">
            <canvas id="chart"></canvas>
        </div>

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

<script>

    var ctx = document.getElementById('chart').getContext('2d');
    data = {
        labels: <?=json_encode($label)?>,
        datasets: [{
            label: 'الاكثر مبيعا',
            data: <?=json_encode($data)?> ,
            borderWidth: 1,
            backgroundColor: ['#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400', '#57AE60', '#894EA0', '#D37400','#27AE60', '#884EA0', '#D35400'],
        }]
    };

    var config = {
        type: 'pie',
        data: data,
        options: {}
    };

    new Chart(
        document.getElementById('chart'),
        config
    );


</script>
