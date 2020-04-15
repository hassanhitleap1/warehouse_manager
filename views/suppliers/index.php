<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Suppliers');
$this->params['breadcrumbs'][] = $this->title;



$columns = [


    [
        'class' => 'kartik\grid\SerialColumn',
        'order' => DynaGrid::ORDER_FIX_LEFT,

    ],
    [
        'attribute' => 'name',
        'visible' => false,
        'value' => 'name'
    ],

    [
        'attribute' => 'phone',
        'visible' => false,
        'value' => 'phone'
    ],


    [
        'attribute' => 'other_phone',
        'visible' => false,
        'value' => 'other_phone'
    ],

    [
        'attribute' => 'site',
        'visible' => false,
        'value' => 'site'
    ],

    [
        'attribute' => 'location',
        'visible' => false,
        'value' => 'location'
    ],
    [
        'attribute' => 'email',
        'visible' => false,
        'value' => 'email'
    ],


    ['class' => 'kartik\grid\CheckboxColumn',  'order' => DynaGrid::ORDER_FIX_RIGHT],
];


?>
<div class="suppliers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create_Supplier'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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




