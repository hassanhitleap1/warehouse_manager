<?php

use Carbon\Carbon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\status\Status;
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
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'order_id',
            [
                'attribute'=>'phone',
                'value' => function ($searchModel) {
                    return    $searchModel->order['user']["phone"];
                },
                'label'=>Yii::t('app','Phone')
            ],

            [
                'attribute'=>'Name',
                'value' => function ($searchModel) {
                    return    $searchModel->order['user']["name"];
                },
                'label'=>Yii::t('app','Name')
            ],

            [
                'attribute'=>'order',
                'value' => function ($searchModel) {
                    $orderItemString = '';
                    foreach ($searchModel->order->orderItems as $orderItem) {
                        $type = '';
                        if (isset($orderItem->product->subProductCount)&& count($orderItem->product->subProductCount) > 1) {
                            $type = $orderItem->subProduct->type;
                        }
                        $orderItemString .= ' ' . $orderItem['product']['name'] . ' ' . $type . ' ' . Yii::t('app', 'Number') . ' ( ' . $orderItem->quantity . ' ) </br>';
                    }
                    return $orderItemString;
                },
                'label'=>Yii::t('app','Order'),
                'format'=>"html"
            ],

            [
                'attribute'=>'status_id',
                'value' => function ($searchModel) {
                    return    $searchModel->status['name_ar'];
                },
                'filter' => ArrayHelper::map(Status::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'),
            ],

            
            [
                'attribute'=>'created_at',
                'value' => function ($searchModel) {
                    return    Carbon::parse($searchModel->created_at)->toDateString();
                },
            ],
            [
                'attribute'=>'time',
                'value' => function ($searchModel) {
                    return    Carbon::parse($searchModel->created_at)->format('g:i A');
                },
            ],

            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
