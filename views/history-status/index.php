<?php

use Carbon\Carbon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\historystatus\HistoryStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'History_Status');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-status-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php  /* Html::a(Yii::t('app', 'Create History Status'), ['create'], ['class' => 'btn btn-success'])  */?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status.name_ar',
            'order_id',
            [
                'attribute'=>'created_at',
                'value' => function ($searchModel) {
                    return    Carbon::parse($searchModel->created_at)->toDateString();
                },
            ],
            [
                'attribute'=>'time',
                'value' => function ($searchModel) {
                    return    Carbon::parse($searchModel->created_at)->toTimeString();
                },
            ],

            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
