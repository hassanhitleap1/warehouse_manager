<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::t('app', 'The_Sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Dashboard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$label_profits_day_model=[];
$data_profits_day_model=[];

$label_profits_month_model=[];
$data_profits_month_model=[];

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= Yii::t('app','Count');?></th>
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
                        <th><?= $profit_day_model["profit_margin"]?> jd</th>
                        <th><?= $profit_day_model["outlays"]?> jd</th>
                        <th><?=$profit_day_model["profit_margin"] - $profit_day_model["outlays"] ?> jd</th>
                        <th><?= $profit_day_model["quantity"]?></th>
                        <th><?= $profit_day_model["month"]?>/<?= $profit_day_model["day"]?></th>
                    </tr>
                    <?php 
                    $data_profits_day_model[]=$profit_day_model["profit_margin"] - $profit_day_model["outlays"];
                    $label_profits_day_model[]=$profit_day_model["month"] ."/". $profit_day_model["day"];?>
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
                    <th><?= Yii::t('app','Count');?></th>
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
                            <th><?= $profit_month_model["profit_margin"]?> jd</th>
                            <th><?= $profit_month_model["outlays"]  ?> jd</th>
                            <th><?= $profit_month_model["profit_margin"]-$profit_month_model["outlays"]?> jd</th>

                            <th><?= $profit_month_model["quantity"]?></th>
                            <th><?= $profit_month_model["month"]?></th>
                        </tr>
                            <?php 
                            $label_profits_month_model[]= $profit_month_model["month"];
                            $data_profits_month_model[]=$profit_month_model["profit_margin"]- $profit_month_model["outlays"];
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

var label_profits_day_model = <?=json_encode($label_profits_day_model)?>;
var  data = {
  labels: label_profits_day_model,
  datasets: [{
    label: 'الارباح اليومية',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
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


var label_profits_month_model = <?=json_encode($label_profits_month_model)?>;


var data = {
  labels: label_profits_month_model,
  datasets: [{
    label: 'الارباح الشهري',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
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


</script>
