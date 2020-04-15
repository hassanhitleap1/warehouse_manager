<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\categorises\Categorises */

$this->title = Yii::t('app', 'Create_Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorises-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
