<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::t('app', 'The_Sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Dashboard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$label=[];
$data=[];
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
   <div class="col-md-6">
      <table class="table table-striped">
      <thead>
        <tr>
          <th><?= Yii::t('app','Product');?></th>
          <th><?= Yii::t('app','Type');?></th>
          <th><?= Yii::t('app','Count');?></th>
          <th><?= Yii::t('app','The_Sales');?></th>
          <th><?= Yii::t('app','Profit_Margin');?></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($orders as $order):?>
        <tr>
          <th><?= $order["name"]?></th>
          <th><?= $order["type"]?></th>
          <th><?= $order["count_quantity"]?></th>
          <th><?= $order["total_sales"]?> JD</th>
          <th><?= $order["profits_margin"]?> JD</th>
        
        </tr>
        <tr>
        <?php 
        
        $label[]=$order["name"];
        $data[]=$order["profits_margin"];
        ?>
      <?php endforeach;?> 
        
      </tbody>
    </table>
   </div>
   <div class="col-md-6">
 
     <canvas id="chart"></canvas>

   </div>

</div>


<script>

var label = <?=json_encode($label)?>;
var  data = {
  labels: label,
  datasets: [{
    label: 'الارباح ',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: <?=json_encode($data)?> ,
  }]
};
var config = {
  type: 'doughnut',
  data: data,
  backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart.js Doughnut Chart'
      }
    }
  },
};

new Chart(
    document.getElementById('chart'),
    config
  );

</script>  
