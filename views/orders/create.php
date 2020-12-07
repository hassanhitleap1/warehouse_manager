<?php

use app\models\ordersitem\OrdersItem;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\orders\Orders */

$this->title = Yii::t('app', 'Create_Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ordersItem' => (empty($ordersItem)) ? [new OrdersItem()] : $ordersItem
    ]) ?>

</div>
