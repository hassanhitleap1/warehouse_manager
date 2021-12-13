<?php

use yii\helpers\Html;

use kartik\dynagrid\DynaGrid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\units\UnitsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Units');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    'name_ar',
    'name_en',
    [
        'class'=>'kartik\grid\ActionColumn',
        'dropdown'=>false,
        'order'=>DynaGrid::ORDER_FIX_RIGHT
    ],
    ['class'=>'kartik\grid\CheckboxColumn',  'order'=>DynaGrid::ORDER_FIX_RIGHT],
];


?>
<div class="units-index">

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
