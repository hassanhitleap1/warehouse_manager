<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\companydelivery\CompanyDelivery */

$this->title = Yii::t('app', 'Create_Company_Delivery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company_Deliveries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-delivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'prices_delivery'=>$prices_delivery,
        'regionsModel'=>$regionsModel
    ]) ?>

</div>
