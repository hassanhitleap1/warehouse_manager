<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::t('app', 'Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Dashboard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$label_day=[];
$data_day=[];
$label_month=[];
$data_month=[];


?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-12">
            <canvas id="status_day"></canvas>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= Yii::t('app','Name');?></th>
                    <th><?= Yii::t('app','Status');?></th>
                    <th><?= Yii::t('app','Count_Orders');?></th>
                    <th><?= Yii::t('app','Date');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($delivery_day as $deliv_day):?>
                    <tr>
                        <th><?= $deliv_day["name"]?></th>
                        <th><?= $deliv_day["count_order"]?> </th>
                        <th><?= $deliv_day["name_ar"]?> </th>
                        <th><?= $deliv_day["created_at"]?> </th>

                    </tr>
                    <?php
                    $label_day[]=$deliv_day["name"];
                    $data_day[]=$deliv_day["count_order"];
                    ?>

                <?php endforeach;?>

                </tbody>
            </table>
        </div>


    </div>

    <hr />

    <div class="row">
        <div class="col-md-6">
            <canvas id="status_month"></canvas>
        </div>
        <div class="col-md-6 " >
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= Yii::t('app','Name');?></th>
                    <th><?= Yii::t('app','Count_Orders');?></th>
                    <th><?= Yii::t('app','Month');?></th>

                </tr>
                </thead>
                <tbody>
                <?php foreach($delivery_month as $deliv_month):?>
                <tr>
                    <th><?= $deliv_month["name"]?></th>
                    <th><?= $deliv_month["count_order"]?> </th>
                    <th><?= $deliv_month["month"]?> </th>

                </tr>
                <?php
                $label_month[]=$deliv_month["name"];
                $data_month[]=$deliv_month["count_order"];
                ?>

                <?php endforeach;?>
               

                </tbody>
            </table>
        </div>
    </div>

</div>


<script>

    new Chart(
        document.getElementById('status_day'),
        {
            type: 'line',
                {
                    labels: <?=json_encode($label_day)?>,
                    datasets: [{
                        label: 'الحالات اليومية',
                        backgroundColor: 'rgb(11, 168, 90)',
                        borderColor: 'rgb(11, 168, 90)',
                        data: <?=json_encode($data_day)?> ,
                        }]
                },
            options: {}
            }
    );




    new Chart(
        document.getElementById('stat'),
            {
                type: 'line',{
                    labels: <?=json_encode($label_month)?>,
                    datasets: [{
                        label: 'عدد الطلبات',
                        backgroundColor: 'rgb(11, 168, 90)',
                        borderColor: 'rgb(11, 168, 90)',
                        data: <?=json_encode($data_month)?> ,
                    }]
                    },
            options: {}
        }
    );




</script>
