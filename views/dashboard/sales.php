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
                <th><?= Yii::t('app','Count');?></th>
                <th><?= Yii::t('app','Profit_Margin');?></th>
                <th><?= Yii::t('app','Quantity');?></th>
                <th><?= Yii::t('app','Date');?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($profits_day_model as $profit_day_model):?>
                <tr>
                    <th><?= $profit_day_model["count_order"]?></th>
                    <th><?= $profit_day_model["profit_margin"]?></th>
                    <th><?= $profit_day_model["quantity"]?></th>
                    <th><?= $profit_day_model["month"]?>/<?= $profit_day_model["day"]?></th>
                </tr>

            <?php endforeach;?>

            </tbody>
        </table>
    </div>
    <div class="row">

        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= Yii::t('app','Count');?></th>
                <th><?= Yii::t('app','Profit_Margin');?></th>
                <th><?= Yii::t('app','Quantity');?></th>
                <th><?= Yii::t('app','Month');?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($profits_month_model as $profit_month_model):?>
                    <tr>
                        <th><?= $profit_month_model["count_order"]?></th>
                        <th><?= $profit_month_model["profit_margin"]?></th>
                        <th><?= $profit_month_model["quantity"]?></th>
                        <th><?= $profit_month_model["month"]?></th>
                    </tr>
                <?php endforeach;?>

            </tbody>
        </table>
    </div>

    


</div>
