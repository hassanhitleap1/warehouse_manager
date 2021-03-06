<?php

use app\models\area\Area;
use app\models\countries\Countries;
use app\models\regions\Regions;
use app\models\status\Status;
use yii\helpers\Html;
use app\models\users\Users;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
$users=Users::find()->orderBy('name')->asArray()->all();
/* @var $this yii\web\View */
/* @var $searchModel app\models\orders\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$status=ArrayHelper::map(Status::find()->all(), 'id', 'name_ar');


$columns = [
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
        'order_id',
        [
            'attribute'=>'user_id', 
            'vAlign'=>'middle',
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) { 
                return Html::a($model->user->name, '#', [
                    'title'=>'View author detail', 
                    'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
                ]);
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map($users, 'id', 'name'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'select user'],
            'format'=>'raw',
            'visible'=>true,
        ],  
        [
            'attribute'=>'phone', 
            'vAlign'=>'middle',
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) { 
                return Html::a($model->user->phone, '#', [
                    'title'=>'View author detail', 
                    'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
                ]);
            },
         
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
       
            'format'=>'raw',
            'visible'=>true,
        ],   
        [
            'attribute'=>'delivery_date',
            'filterType'=>GridView::FILTER_DATE,
            'format'=>'raw',
            'width'=>'170px',
            'filterWidgetOptions'=>[
                'pluginOptions'=>['format'=>'yyyy-mm-dd']
            ],
            'visible'=>true,
        ],


        [
            'attribute'=>'country_id', 
            'vAlign'=>'middle',
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) { 
                return Html::a($model->country->name_ar, '#', [
                    'title'=>'View author detail', 
                    'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
                ]);
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Countries::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'select user'],
            'format'=>'raw',
            'visible'=>true,
        ],


        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute'=>'status_id', 
            'vAlign'=>'middle',
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) { 
                    
                return Html::a($model->status->name_ar, '#', [
                    'title'=>'View author detail', 
                    'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
                ]);
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Status::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'select status'],
            'format'=>'html',
            'visible'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'status', 
                    'size'=>'md',
                    'inputType' => 'dropDownList',
                    'data'=>ArrayHelper::map(Status::find()->all(), 'id', 'name_ar'),
                    'formOptions'=>['action' => ['/orders/change-status','id'=>$model->id]],
                    
                ];
            },
            
           
        ],

        [
            'attribute'=>'region_id', 
            'vAlign'=>'middle',
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) { 
                return Html::a($model->region->name_ar, '#', [
                    'title'=>'View author detail', 
                    'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
                ]);
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Regions::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'select user'],
            'format'=>'raw',
            'visible'=>true,
        ],
        [  
            'attribute'=>'area_id', 
            'vAlign'=>'middle',
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) { 
                return Html::a($model['area']['name_ar'], '#', [
                    'title'=>'View author detail', 
                    'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
                ]);
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Area::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'select user'],
            'format'=>'raw',
            'visible'=>true,
        ], 

        'address',


        [
            'attribute'=>'created_at',
            'filterType'=>GridView::FILTER_DATE,
            'format'=>'raw',
            'width'=>'170px',
            'filterWidgetOptions'=>[
                'pluginOptions'=>['format'=>'yyyy-mm-dd']
            ],
            'visible'=>true,
        ],

    [
        'class'=>'kartik\grid\ActionColumn',
        'dropdown'=>false,
        'order'=>DynaGrid::ORDER_FIX_RIGHT
    ],
    ['class'=>'kartik\grid\CheckboxColumn',  'order'=>DynaGrid::ORDER_FIX_RIGHT],
];




?>
<div class="orders-index">
    <?=  DynaGrid::widget([
    'columns'=>$columns,
    'storage'=>DynaGrid::TYPE_COOKIE,
    'theme'=>'panel-success',
    'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'panel'=>[
            'heading'=>'<h3 class="panel-title">'.$this->title.'</h3>',
            'before'=>'{dynagrid}' .  Html::a(Yii::t('app', 'Create_Order'), ['create'], ['class' => 'btn btn-success'])
           ],

    ],
    
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]);
   
    
    ?>

</div>
