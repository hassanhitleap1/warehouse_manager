<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\historystatus\HistoryStatus */

$this->title = Yii::t('app', 'Create History Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'History Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
