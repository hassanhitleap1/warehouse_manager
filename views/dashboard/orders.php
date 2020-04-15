<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = Yii::t('app','Dashboard');
$this->params['breadcrumbs'][] = $this->title;
$label_month=[];
$label_day=[];
$data_orders_day=[];
$data_grains_day=[];
$data_profits_day=[];
$data_orders_month=[];
$data_grains_month=[];
$data_profits_month=[];


?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-4">
            <canvas id="orders_day"></canvas>

        </div>
        <div class="col-md-4">
            <canvas id="profits_day"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="quantities_day"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= Yii::t('app','Count_Orders');?></th>
                <th scope="col"><?= Yii::t('app','Total_Sales');?></th>
                <th scope="col"><?= Yii::t('app','Number_Of_Grains');?></th>
                <th scope="col"><?= Yii::t('app','Profits');?></th>
                <th scope="col"><?= Yii::t('app','Date');?></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($day_data as $key_day => $day_data):?>
                    <tr>
                        <th scope="row"><?= ++ $key_day?></th>
                        <td><?= $day_data["count_order"]?></td>
                        <td><?= $day_data["total_sales"]?></td>
                        <td><?= $day_data["quantities"]?></td>
                        <td><?= round( $day_data["profits_margin"] ,2)?></td>
                        <td><?= $day_data["date"]?></td>
                    </tr>
                <?php
                    $label_day[]=$day_data["date"];
                    $data_orders_day[]= $day_data["count_order"]  ;
                    $data_grains_day[]= $day_data["quantities"];
                    $data_profits_day[]=round( $day_data["profits_margin"] ,2)
                    ?>
                <?php endforeach;?>


            </tbody>
        </table>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <canvas id="profits_month"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="orders_month"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="quantities_month"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= Yii::t('app','Count_Orders');?></th>
                    <th scope="col"><?= Yii::t('app','Total_Sales');?></th>
                    <th scope="col"><?= Yii::t('app','Number_Of_Grains');?></th>
                    <th scope="col"><?= Yii::t('app','Profits');?></th>
                    <th scope="col"><?= Yii::t('app','Month');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($month_data as $key_day => $month_data):?>
                    <tr>
                        <th scope="row"><?= ++ $key_day?></th>
                        <td><?= $month_data["count_order"]?></td>
                        <td><?= $month_data["total_sales"]?></td>
                        <td><?= $month_data["quantities"]?></td>
                        <td><?= round( $month_data["profits_margin"] ,2)?></td>
                        <td><?= $month_data["month"]?></td>
                    </tr>
                    <?php
                    $label_month[]=$month_data["month"];
                    $data_orders_month[]= $month_data["count_order"]  ;
                    $data_grains_month[]= $month_data["quantities"];
                    $data_profits_month[]=round( $month_data["profits_margin"] ,2)
                    ?>
                <?php endforeach;?>


                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


    <script  type="text/javascript">
        var canvas ;
        var data ;
        var label_day = <?php echo json_encode($label_day); ?>;
        var label_month = <?php echo json_encode($label_month); ?>;



        canvas = document.getElementById('orders_day').getContext('2d');
        data= {
                labels:  label_day,
                datasets: [{
                    label: 'الطلبات اليومية',
                    backgroundColor: 'rgb(11, 168, 90)',
                    borderColor: 'rgb(11, 168, 90)',
                    data: <?php echo json_encode($data_orders_day); ?>
                }]
            };
        new Chart(canvas, {
            type: 'bar',
            data:data,
            options: {}
        });

        canvas = document.getElementById('profits_day').getContext('2d');
        data= {
            labels:  label_day,
            datasets: [{
                label: 'الارباح اليومية',
                backgroundColor: 'rgb(11, 168, 90)',
                borderColor: 'rgb(11, 168, 90)',
                data: <?php echo json_encode($data_profits_day); ?>
            }]
        };
        new Chart(canvas, {
            type: 'bar',
            data:data,
            options: {}
        });


        canvas = document.getElementById('quantities_day').getContext('2d');
        data= {
            labels:  label_day,
            datasets: [{
                label: 'عدد الحبات اليومية',
                backgroundColor: 'rgb(11, 168, 90)',
                borderColor: 'rgb(11, 168, 90)',
                data: <?php echo json_encode($data_grains_month); ?>
            }]
        };
        new Chart(canvas, {
            type: 'bar',
            data:data,
            options: {}
        });



        canvas = document.getElementById('orders_month').getContext('2d');
        data= {
            labels:  label_month,
            datasets: [{
                label: 'الطلبات الشهرية',
                backgroundColor: 'rgb(11, 168, 90)',
                borderColor: 'rgb(11, 168, 90)',
                data: <?php echo json_encode($data_orders_month); ?>
            }]
        };
        new Chart(canvas, {
            type: 'bar',
            data:data,
            options: {}
        });

        canvas = document.getElementById('profits_month').getContext('2d');
        data= {
            labels:  label_month,
            datasets: [{
                label: 'الارباح الشهرية',
                backgroundColor: 'rgb(11, 168, 90)',
                borderColor: 'rgb(11, 168, 90)',
                data: <?php echo json_encode($data_profits_month); ?>
            }]
        };
        new Chart(canvas, {
            type: 'bar',
            data:data,
            options: {}
        });


        canvas = document.getElementById('quantities_month').getContext('2d');
        data= {
            labels:  label_month,
            datasets: [{
                label: 'عدد الحبات الشهرية',
                backgroundColor: 'rgb(11, 168, 90)',
                borderColor: 'rgb(11, 168, 90)',
                data: <?php echo json_encode($data_grains_month); ?>
            }]
        };
        new Chart(canvas, {
            type: 'bar',
            data:data,
            options: {}
        });









      

    </script>

</div>
