<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\products\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;


$columns = [


    [
        'class' => 'kartik\grid\SerialColumn',
        'order' => DynaGrid::ORDER_FIX_LEFT,

    ],
    [
        'attribute' => 'username',
        'visible' => false,
        'value' => 'username'
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
        'attribute' => 'name',
        'visible' => false,
        'value' => 'name'
    ],

    [
        'attribute' => 'address',
        'visible' => false,
        'value' => 'address'
    ],
    [
        'attribute' => 'email',
        'visible' => false,
        'value' => 'email'
    ],


    ['class' => 'kartik\grid\CheckboxColumn',  'order' => DynaGrid::ORDER_FIX_RIGHT],
];
/* @var $this yii\web\View */
/* @var $searchModel app\models\orders\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* skip-export add class to export */

?>
<div class="users-index">

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
