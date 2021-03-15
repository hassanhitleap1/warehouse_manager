<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OptionsSellProduct\OptionsSellProduct */

$this->title = Yii::t('app', 'Create Options Sell Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Options Sell Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-sell-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
