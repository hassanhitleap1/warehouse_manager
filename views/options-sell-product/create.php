<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OptionsSellProduct\OptionsSellProduct */

$this->title = Yii::t('app', 'Create_Options_Sell_Products');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Options_Sell_Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-sell-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
