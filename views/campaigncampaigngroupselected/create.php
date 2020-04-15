<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\campaigncampaigngroupselected\CampaignGroupSelected */

$this->title = Yii::t('app', 'Create Campaign Group Selected');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campaign Group Selecteds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campaign-group-selected-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
