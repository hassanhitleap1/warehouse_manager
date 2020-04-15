<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
/* @var $this yii\web\View */
/* @var $searchModel app\models\warehouse\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$columns = [
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    'name',
    'localtion',
    [
        'class'=>'kartik\grid\ActionColumn',
        'dropdown'=>false,
        'order'=>DynaGrid::ORDER_FIX_RIGHT
    ],
    ['class'=>'kartik\grid\CheckboxColumn',  'order'=>DynaGrid::ORDER_FIX_RIGHT],
];

$this->title = Yii::t('app', 'Warehouses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=  DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-success',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'panel'=>[
                'heading'=>'<h3 class="panel-title">'.$this->title.'</h3>',
                'before'=>'{dynagrid}' . Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success'])
            ],

        ],

        'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
    ]); ?>

</div>
