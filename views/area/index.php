<?php

use kartik\grid\GridView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\models\area\AreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Areas');
$this->params['breadcrumbs'][] = $this->title;


$gridColumns=[
    'name_ar',
    'name_en',
    [
        'attribute' => 'region_id',
        'value' => 'region.name_ar',

    ],
];

?>
<div class="area-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create_Area'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'toolbar' => [
        [
            'content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                    'type'=>'button', 
                    'title'=>Yii::t('app', 'Add Book'), 
                    'class'=>'btn btn-success'
                ]) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                    'class' => 'btn btn-default', 
                    'title' => Yii::t('app', 'Reset Grid')
                ]),
        ],
        '{export}',
        '{toggleData}',
        'showPageSummary' => true,
        'exportConfig' => [
            GridView::CSV => ['label' => 'Save as CSV'],
            GridView::HTML =>  ['label' => 'Save as CSV'],
            GridView::PDF => ['label' => 'Save as CSV'],
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Countries</h3>',
            'type'=>'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],
    
    
    ]
    
]);
    
    ?>

 