<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Outlays\Outlays */

$this->title = Yii::t('app', 'Create_Outlay');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Outlays'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlays-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
