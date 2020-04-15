<?php

/* @var $this yii\web\View */

use app\models\products\Products;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = Yii::t('app', 'The_Sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Dashboard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$label_profits_day_model=[];
$data_profits_day_model=[];
$data_orders_day_model=[];
$data_sales_day_model=[];
$data_outlays_day_model=[];


$label_profits_month_model=[];
$data_profits_month_model=[];
$data_orders_month_model=[];
$data_sales_month_model=[];
$data_outlays_month_model=[];
$products=ArrayHelper::map(Products::find()->orderBy(['id' => SORT_DESC])->all(), 'id', 'name');

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row" style="margin:10px">
        <?php $form = ActiveForm::begin([
            'action' => ['dashboard/sales'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

        <div class="col-md-5">
            <label class="control-label"><?=Yii::t('app','Created_At')?></label>
            <?= DateRangePicker::widget([
                'model'=>$model,
                'value'=>$date_range,
                'language' => 'en',
                'attribute'=>'created_at',
                'readonly'=>true,
                'convertFormat'=>true,
                'options' => ['class' => 'form-control' ,"autocomplete"=>"off" ,"autocomplete"=>"no-fill",   'value'=>$date_range],
                'pluginOptions'=>[
                    'timePicker'=>true,
                    'timePickerIncrement'=>30,
                    'locale'=>[
                        'format'=>'Y-m-d'
                    ]
                ]
            ]);

            ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model,"product_id")->widget(Select2::classname(), [
                'data' => $products,
                'language' => 'ar',
                'options' => ['multiple' => true,'placeholder' =>Yii::t('app',"Plz_Select"),'class'=>'product_id','value'=>$product_id],

            ]); ?>

        </div>

        <div class="col-md-2" style="margin-top: 27px;">

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary search_order']) ?>
                <?= Html::a(Yii::t('app', 'Reset'), ['/dashboard/sales'],['class' => 'btn btn-outline-secondary']) ?>
            </div>

        </div>




        <?php ActiveForm::end(); ?>


    </div>

    <div class="row">
        <div class="col-md-6">
            <canvas id="profits_day_model"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="orders_day_model"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="sales_day_model"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="outlays_day_model"></canvas>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= Yii::t('app','Count_Orders');?></th>
                    <th scope="col"><?= Yii::t('app','Total_Sales');?></th>
                    <th><?= Yii::t('app','Profit_Margin');?></th>
                    <th><?= Yii::t('app','Outlays');?></th>
                    <th><?= Yii::t('app','Total');?>   <?= Yii::t('app','Profit_Margin');?></th>
                    <th><?= Yii::t('app','Number_Of_Grains');?></th>
                    <th><?= Yii::t('app','Date');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($profits_day_model as $profit_day_model):?>
                    <tr>
                        <th><?= $profit_day_model["count_order"]?></th>
                        <td><?= $profit_day_model["total_sales"]?></td>
                        <th><?= round($profit_day_model["profit_margin"],2)?> jd</th>
                        <th><?= round($profit_day_model["outlays"],2)?> jd</th>
                        <th><?= round($profit_day_model["profit_margin"] - $profit_day_model["outlays"],2) ?> jd</th>
                        <th><?= $profit_day_model["quantity"]?></th>
                        <th><?= $profit_day_model["month"]?>/<?= $profit_day_model["day"]?></th>
                    </tr>
                    <?php 
                        $data_profits_day_model[]= round($profit_day_model["profit_margin"] - $profit_day_model["outlays"],2);
                        $label_profits_day_model[]=$profit_day_model["month"] ."/". $profit_day_model["day"];
                        $data_orders_day_model[]= $profit_day_model["count_order"];
                        $data_outlays_day_model[]=round($profit_day_model["outlays"],2);
                        $data_sales_day_model=$profit_day_model["total_sales"];
                    ?>

                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
    <hr />

    <div class="row">
        <div class="col-md-6">
            <canvas id="profits_month_model"></canvas>
        </div>
        <div class="col-md-6 " >
            <canvas id="orders_month_model"></canvas>
        </div>

        <div class="col-md-6">
            <canvas id="sales_month_model"></canvas>
        </div>
        <div class="col-md-6 " >
            <canvas id="outlays_month_model"></canvas>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= Yii::t('app','Count_Orders');?></th>
                    <th scope="col"><?= Yii::t('app','Total_Sales');?></th>
                    <th><?= Yii::t('app','Profit_Margin');?></th>
                    <th><?= Yii::t('app','Outlays');?></th>
                    <th><?= Yii::t('app','Total');?>   <?= Yii::t('app','Profit_Margin');?></th>
                    <th><?= Yii::t('app','Number_Of_Grains');?></th>
                    <th><?= Yii::t('app','Month');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($profits_month_model as $profit_month_model):?>
                        <tr>
                            <th><?= $profit_month_model["count_order"]?></th>
                            <td><?= $profit_month_model["total_sales"]?></td>
                            <th><?= round($profit_month_model["profit_margin"] ,2)?> jd</th>
                            <th><?= round($profit_month_model["outlays"],2)  ?> jd</th>
                            <th><?= round($profit_month_model["profit_margin"]-$profit_month_model["outlays"] ,2)?> jd</th>

                            <th><?= $profit_month_model["quantity"]?></th>
                            <th><?= $profit_month_model["month"]?></th>
                        </tr>
                            <?php 
                                $label_profits_month_model[]= $profit_month_model["month"];
                                $data_profits_month_model[]= round($profit_month_model["profit_margin"]- $profit_month_model["outlays"],2);
                                $data_orders_month_model[]= $profit_month_model["count_order"];
                                $data_outlays_month_model=round($profit_month_model["outlays"],2);
                                $data_sales_month_model=$profit_month_model["total_sales"];
                    ?>
                    <?php endforeach;?>
                    
                </tbody>
            </table>
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
        label: 'المصاريف اليومية',
        backgroundColor: 'rgb(11, 168, 90)',
        borderColor: 'rgb(11, 168, 90)',
        data: <?=json_encode($data_outlays_day_model)?> ,
    }]
};
var  config = {
    type: 'line',
    data,
    options: {}
};
new Chart(
    document.getElementById('outlays_day_model'),
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

var  data = {
    labels: label_profits_day_model,
    datasets: [{
        label: 'المبيعات اليومية',
        backgroundColor: 'rgb(11, 168, 90)',
        borderColor: 'rgb(11, 168, 90)',
        data: <?=json_encode($data_sales_day_model)?> ,
    }]
};
var  config = {
    type: 'line',
    data,
    options: {}
};
new Chart(
    document.getElementById('sales_day_model'),
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



var data = {
    labels: label_profits_month_model,
    datasets: [{
        label: 'المبيعات الشهري',
        backgroundColor: 'rgb(11, 168, 90)',
        borderColor: 'rgb(11, 168, 90)',
        data: <?=json_encode($data_sales_month_model)?> ,
    }]
};

var config = {
    type: 'line',
    data,
    options: {}
};

new Chart(
    document.getElementById('sales_month_model'),
    config
);


var data = {
    labels: label_profits_month_model,
    datasets: [{
        label: 'المصاريف الشهري',
        backgroundColor: 'rgb(11, 168, 90)',
        borderColor: 'rgb(11, 168, 90)',
        data: <?=json_encode($data_outlays_month_model)?> ,
    }]
};

var config = {
    type: 'line',
    data,
    options: {}
};

new Chart(
    document.getElementById('outlays_month_model'),
    config
);

</script>
