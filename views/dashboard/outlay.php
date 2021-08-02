<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::t('app', 'The_Sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Dashboard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$label_outlays_day_model=[];
$data_outlays_day_model=[];

$label_outlays_month_model=[];
$data_outlays_month_model=[];

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?= Yii::t('app','Outlays');?></th>
                    <th><?= Yii::t('app','Day');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($outlays_day_model as $key_day => $outlay_day_model):?>
                    <tr>
                        <th><?= ++ $key_day?></th>
                        <th><?= $outlay_day_model["outlays"]?></th>
                        <th><?= $outlay_day_model["created_at"]?></th>
                    </tr>
                    <?php
                    $label_outlays_day_model[]=$outlay_day_model["created_at"];
                    $data_outlays_day_model[]=$outlay_day_model["outlays"] ?>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <canvas id="profits_day_model"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?= Yii::t('app','Outlays');?></th>
                    <th><?= Yii::t('app','Date');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($outlays_month_model as $key_month => $outlay_month_model):?>
                    <tr>
                        <th><?= ++ $key_month?></th>
                        <th><?= $outlay_month_model["outlays"]?></th>
                        <th><?= $outlay_month_model["month"]?></th>
                    </tr>
                    <?php
                    $label_outlays_month_model[]= $outlay_month_model["month"];
                    $data_outlays_month_model[]=$outlay_month_model["outlays"];
                    ?>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <canvas id="profits_month_model"></canvas>
        </div>
    </div>

</div>


<script>

    var label = <?=json_encode($label_outlays_day_model)?>;

    var  data = {
        labels: label,
        datasets: [{
            label: 'الننفقات اليومية',
            backgroundColor: 'rgb(252, 35, 35)',
            borderColor: 'rgb(252, 35, 35)',
            data: <?=json_encode($data_outlays_day_model)?> ,
        }]
    };
    var  config = {
        type: 'line',
        data,
        options: {}
    };
    new Chart(
        document.getElementById('profits_day_model'),
        config
    );


    label = <?=json_encode($label_outlays_month_model)?>;



    var data = {
        labels: label,
        datasets: [{
            label: 'النفقات الشهري',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?=json_encode($data_outlays_month_model)?> ,
        }]
    };

    var config = {
        type: 'line',
        data,
        options: {}
    };

    new Chart(
        document.getElementById('profits_month_model'),
        config
    );


</script>
