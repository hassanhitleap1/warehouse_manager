<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use yii\widgets\Pjax;


$columns = [

    [
        'class' => 'kartik\grid\SerialColumn',
        'order' => DynaGrid::ORDER_FIX_LEFT,

    ],
    [
        'attribute' => 'country_code',
        'visible' => false,
        'value' => 'country_code'
    ],


    [
        'attribute' => 'name_en',
        'visible' => false,
        'value' => 'name_en'
    ],


    [
        'attribute' => 'name_ar',
        'visible' => false,
        'value' => 'name_ar'
    ],

    [
        'attribute' => 'nationality_en',
        'visible' => false,
        'value' => 'nationality_en'
    ],

    [
        'attribute' => 'nationality_ar',
        'visible' => false,
        'value' => 'nationality_ar'
    ],


    ['class' => 'kartik\grid\CheckboxColumn',  'order' => DynaGrid::ORDER_FIX_RIGHT],
];

/* @var $this yii\web\View */
/* @var $searchModel app\models\orders\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* skip-export add class to export */

$this->title = Yii::t('app', 'Countries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countries-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>



    <?= DynaGrid::widget([
        'columns' => $columns,
        'storage' => DynaGrid::TYPE_COOKIE,
        'theme' => 'panel-success',
        'gridOptions' => [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'panel' => [
                'heading' => '<h3 class="panel-title">' . $this->title . '</h3>',
                'before' => '{dynagrid}' .  Html::a( "<span class='glyphicon glyphicon-plus' > </span>", ['create'], ['class' => 'btn btn-success' ,'title'=>Yii::t('app', 'Create')])
            ],
            'showPageSummary' => true,
        ],

        'options' => ['id' => 'dynagrid'],  // a unique identifier is important

    ]);


    ?>

    <?php Pjax::end(); ?>

</div>
