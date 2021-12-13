<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\regions\RegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Regions');
$this->params['breadcrumbs'][] = $this->title;


$columns = [

    [
        'class' => 'kartik\grid\SerialColumn',
        'order' => DynaGrid::ORDER_FIX_LEFT,

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
        'attribute' => 'price_delivery',
        'visible' => false,
        'value' => 'price_delivery'
    ],

    [
        'attribute' => 'country_id',
        'visible' => false,
        'value' => 'country.name_ar'
    ],


    ['class' => 'kartik\grid\CheckboxColumn',  'order' => DynaGrid::ORDER_FIX_RIGHT],
];

?>
<div class="regions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
