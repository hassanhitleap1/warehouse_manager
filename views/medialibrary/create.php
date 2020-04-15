<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\medialibrary\Medialibrary */

$this->title = Yii::t('app', 'Create Medialibrary');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Medialibraries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medialibrary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
