<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeOutlay\TypeOutlay */

$this->title = Yii::t('app', 'Create_Type_Outlay');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type_Outlay'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-outlay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
