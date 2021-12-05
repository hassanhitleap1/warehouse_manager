<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\upsell\Upsell */

$this->title = Yii::t('app', 'Create Upsell');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Upsells'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upsell-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
