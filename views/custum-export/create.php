<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\custumexport\CustumExport */

$this->title = Yii::t('app', 'Create Custum Export');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Custum Exports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custum-export-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
