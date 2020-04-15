<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\groupssubscribe\GroupsSubscribe */

$this->title = Yii::t('app', 'Update Groups Subscribe: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups Subscribes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="groups-subscribe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
