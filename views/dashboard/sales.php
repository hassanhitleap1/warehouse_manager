<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::t('app', 'The_Sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Dashboard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">

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
            <?php foreach($profits_day_model as $profit_day_model):?>
                <tr>
                    <th><?= $order["name"]?></th>
                    <th><?= $order["type"]?></th>
                    <th><?= $order["count_quantity"]?></th>
                    <th><?= $order["total_sales"]?> JD</th>
                    <th><?= $order["profits_margin"]?> JD</th>

                </tr>
                <tr>
            <?php endforeach;?>

            </tbody>
        </table>
    </div>
    <div class="row">

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
            <?php foreach($profits_month_model as $profit_month_model):?>
            <tr>
                <th><?= $order["name"]?></th>
                <th><?= $order["type"]?></th>
                <th><?= $order["count_quantity"]?></th>
                <th><?= $order["total_sales"]?> JD</th>
                <th><?= $order["profits_margin"]?> JD</th>

            </tr>
            <tr>
                <?php endforeach;?>

            </tbody>
        </table>
    </div>

    


</div>
