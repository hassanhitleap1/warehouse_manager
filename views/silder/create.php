<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\silder\Silder */

$this->title = Yii::t('app', 'Create Silder');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Silders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="silder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
