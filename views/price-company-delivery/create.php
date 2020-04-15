<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pricecompanydelivery\PriceCompanyDelivery */

$this->title = Yii::t('app', 'Create Price Company Delivery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Price Company Deliveries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-company-delivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
