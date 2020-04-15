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
          <th><?= round( $order["total_sales"],2)?> JD</th>
          <th><?= round( $order["profits_margin"] ,2)?> JD</th>
        
        </tr>
        <tr>
        <?php 
        
        $label[]=$order["name"];
        $data[]=round($order["profits_margin"] ,2);
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
