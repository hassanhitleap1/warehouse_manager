<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\products\Products */

$this->title = Yii::t('app', 'Create_Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'subProductCounts'=>$subProductCounts
    ]) ?>

</div>
