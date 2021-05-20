<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\companydelivery\CompanyDelivery */

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company_Deliveries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="company-delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'prices_delivery'=>$prices_delivery,
        'regionsModel'=>$regionsModel
    ]) ?>

</div>
