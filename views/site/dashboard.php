<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;


//$label_month;
// $label_day;
// $orders_count_month;
// $orders_count_day; 
// $profits_month;

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
      
        var label_day = <?php echo json_encode($label_day); ?>;
        var label_month = <?php echo json_encode($label_month); ?>;
        
        var profits_day = <?php echo json_encode($profits_day); ?>;
        var orders_count_day = <?php echo json_encode($orders_count_day); ?>;
        var profits_month = <?php echo json_encode($profits_month); ?>;
        var orders_count_month = <?php echo json_encode($orders_count_month); ?>;
     
        let data_profits_day= {
                labels:  label_day,
                datasets: [{
                    label: 'ارباح اليومية',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: profits_day
                }]
            };

        let data_orders_day= {
                labels:  label_day,
                datasets: [{
                    label: 'الطلبات اليومية',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: orders_count_day
                }]
            };    


        let data_profits_month= {
                labels:  label_month,
                datasets: [{
                    label: 'ارباح الشهرية',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: profits_month
                }]
            };

           
        let data_orders_month= {
                labels:  label_month,
                datasets: [{
                    label: 'الطلبات الشهرية',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: orders_count_month
                }]
            };     


      
        var chart_profits_day = new Chart(canvas_profits_day, {
            type: 'line',
            data:data_profits_day,
            options: {}
        });
        var chart_order_day = new Chart(canvas_order_day, {
            type: 'bar',
            data:data_profits_month,
            options: {}
        });
        var chart_profits_month= new Chart(canvas_profits_month, {
            type: 'line',
            data:data_profits_month,
            options: {}
        });
        var chart_order_month = new Chart(canvas_order_month, {
            type: 'bar',
            data:data_orders_month,
            options: {}
        });
    </script>

</div>
