<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ordersitem\OrdersItem */

$this->title = Yii::t('app', 'Create Orders Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
