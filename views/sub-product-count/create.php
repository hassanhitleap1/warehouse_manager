<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\subproductcount\SubProductCount */

$this->title = Yii::t('app', 'Create_SubProductCount');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SubProductCount'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-product-count-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
