<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pricecompanydelivery\PriceCompanyDelivery */

$this->title = Yii::t('app', 'Update Price Company Delivery: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Price Company Deliveries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="price-company-delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
