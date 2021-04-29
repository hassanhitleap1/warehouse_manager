<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subscribers\Subscribers */

$this->title = Yii::t('app', 'Create Subscribers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subscribers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
