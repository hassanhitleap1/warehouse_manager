<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::t('app', 'The_Sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Dashboard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$label_profits_day_model=[];
$data_profits_day_model=[];
$data_orders_day_model=[];

$label_profits_month_model=[];
$data_profits_month_model=[];
$data_orders_month_model=[];

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= Yii::t('app','Count_Orders');?></th>
                    <th><?= Yii::t('app','Profit_Margin');?></th>
                    <th><?= Yii::t('app','Outlays');?></th>
                    <th><?= Yii::t('app','Total');?>   <?= Yii::t('app','Profit_Margin');?></th>
                    <th><?= Yii::t('app','Quantity');?></th>
                    <th><?= Yii::t('app','Date');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($profits_day_model as $profit_day_model):?>
                    <tr>
                        <th><?= $profit_day_model["count_order"]?></th>
                        <th><?= round($profit_day_model["profit_margin"],2)?> jd</th>
                        <th><?= $profit_day_model["outlays"]?> jd</th>
                        <th><?= round($profit_day_model["profit_margin"] - $profit_day_model["outlays"],2) ?> jd</th>
                        <th><?= $profit_day_model["quantity"]?></th>
                        <th><?= $profit_day_model["month"]?>/<?= $profit_day_model["day"]?></th>
                    </tr>
                    <?php 
                        $data_profits_day_model[]= round($profit_day_model["profit_margin"] - $profit_day_model["outlays"],2);
                        $label_profits_day_model[]=$profit_day_model["month"] ."/". $profit_day_model["day"];
                        $data_orders_day_model[]= $profit_day_model["count_order"];
                    ?>

                <?php endforeach;?>

                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <canvas id="profits_day_model"></canvas>
        </div>
        <div class="col-md-6 ">
            <canvas id="orders_day_model"></canvas>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= Yii::t('app','Count_Orders');?></th>
                    <th><?= Yii::t('app','Profit_Margin');?></th>
                    <th><?= Yii::t('app','Outlays');?></th>
                    <th><?= Yii::t('app','Total');?>   <?= Yii::t('app','Profit_Margin');?></th>
                    <th><?= Yii::t('app','Quantity');?></th>
                    <th><?= Yii::t('app','Month');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($profits_month_model as $profit_month_model):?>
                        <tr>
                            <th><?= $profit_month_model["count_order"]?></th>
                            <th><?= round($profit_month_model["profit_margin"] ,2)?> jd</th>
                            <th><?= $profit_month_model["outlays"]  ?> jd</th>
                            <th><?= round($profit_month_model["profit_margin"]-$profit_month_model["outlays"] ,2)?> jd</th>

                            <th><?= $profit_month_model["quantity"]?></th>
                            <th><?= $profit_month_model["month"]?></th>
                        </tr>
                            <?php 
                                $label_profits_month_model[]= $profit_month_model["month"];
                                $data_profits_month_model[]= round($profit_month_model["profit_margin"]- $profit_month_model["outlays"],2);
                                $data_orders_month_model[]= $profit_month_model["count_order"];
                            ?>
                    <?php endforeach;?>
                    
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <canvas id="profits_month_model"></canvas>
        </div>
        <div class="col-md-6 col-md-offset-6" >
            <canvas id="orders_month_model"></canvas>
        </div>
    </div>

</div>


<script>

var label_profits_day_model = <?=json_encode($label_profits_day_model)?>;
var  data = {
  labels: label_profits_day_model,
  datasets: [{
    label: 'الارباح اليومية',
    backgroundColor: 'rgb(11, 168, 90)',
            borderColor: 'rgb(11, 168, 90)',
    data: <?=json_encode($data_profits_day_model)?> ,
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


var  data = {
    labels: label_profits_day_model,
    datasets: [{
        label: 'عدد الطلبات',
        backgroundColor: 'rgb(11, 168, 90)',
            borderColor: 'rgb(11, 168, 90)',
        data: <?=json_encode($data_orders_day_model)?> ,
    }]
};
var  config = {
    type: 'line',
    data,
    options: {}
};
new Chart(
    document.getElementById('orders_day_model'),
    config
);


var label_profits_month_model = <?=json_encode($label_profits_month_model)?>;


var data = {
  labels: label_profits_month_model,
  datasets: [{
    label: 'الارباح الشهري',
    backgroundColor: 'rgb(11, 168, 90)',
            borderColor: 'rgb(11, 168, 90)',
    data: <?=json_encode($data_profits_month_model)?> ,
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


var data = {
    labels: label_profits_month_model,
    datasets: [{
        label: 'الطلبات الشهري',
        backgroundColor: 'rgb(11, 168, 90)',
            borderColor: 'rgb(11, 168, 90)',
        data: <?=json_encode($data_orders_month_model)?> ,
    }]
};

var config = {
    type: 'line',
    data,
    options: {}
};

new Chart(
    document.getElementById('orders_month_model'),
    config
);


</script>
