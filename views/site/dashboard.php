<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
        <canvas id="profits_day"></canvas>
        </div>
        <div class="col-md-6">
    
            <canvas id="order_day"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <canvas id="profits_month"></canvas>
        </div>
        <div class="col-md-6">
    
            <canvas id="order_month"></canvas>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script  type="text/javascript">
        var canvas_profits_day = document.getElementById('profits_day').getContext('2d');
        var canvas_order_day = document.getElementById('order_day').getContext('2d');
        var canvas_profits_month = document.getElementById('profits_month').getContext('2d');
        var canvas_order_month = document.getElementById('order_month').getContext('2d');
        let data= {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45]
                }]
            };
        var chart_profits_day = new Chart(canvas_profits_day, {
            type: 'line',
            data:data,
            options: {}
        });
        var chart_order_dayday = new Chart(canvas_order_day, {
            type: 'bar',
            data:data,
            options: {}
        });


        var chart_profits_month= new Chart(canvas_profits_month, {
            type: 'line',
            data:data,
            options: {}
        });
        var chart_order_month = new Chart(canvas_order_month, {
            type: 'bar',
            data:data,
            options: {}
        });
    </script>

</div>
