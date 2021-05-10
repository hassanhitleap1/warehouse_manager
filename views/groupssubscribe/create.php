<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\groupssubscribe\GroupsSubscribe */

$this->title = Yii::t('app', 'Create Groups Subscribe');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups Subscribes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-subscribe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
