<?php

use app\models\area\Area;
use app\models\countries\Countries;
use app\models\regions\Regions;
use app\models\status\Status;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use app\models\users\Users;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$users = Users::find()->orderBy('name')->asArray()->all();
/* @var $this yii\web\View */
/* @var $searchModel app\models\orders\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$status = ArrayHelper::map(Status::find()->all(), 'id', 'name_ar');


$columns = [


    [
        'class' => 'kartik\grid\SerialColumn',
        'order' => DynaGrid::ORDER_FIX_LEFT,

    ],


    'order_id',

    [
        'attribute' => 'created_at',
        'filterType' => GridView::FILTER_DATE,
        'format' => 'raw',
        'width' => '100px',
        'filterWidgetOptions' => [
            'pluginOptions' => ['format' => 'yyyy-mm-dd']
        ],
        'visible' => true,
        'value' => function ($model, $key, $index, $widget) {
            return  date('Y-m-d', strtotime($model->created_at));
        },
    ],

    [
        'attribute' => 'user_id',
        'vAlign' => 'middle',
        'width' => '100px',
        'value' => function ($model, $key, $index, $widget) {
            return $model['user']['name'];
        },



        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],

        'format' => 'raw',
        'visible' => true,
    ],
    [
        'attribute' => 'phone',
        'vAlign' => 'middle',
        'width' => '100px',
        'value' => function ($model, $key, $index, $widget) {
            return '<a href="tel:' . $model['user']['phone'] . '">' . $model['user']['phone'] . '</a>';
        },

        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],

        'format' => 'raw',
        'visible' => true,
    ],
    [
        'attribute' => 'delivery_date',
        'filterType' => GridView::FILTER_DATE,
        'format' => 'raw',
        'width' => '100px',
        'filterWidgetOptions' => [
            'pluginOptions' => ['format' => 'yyyy-mm-dd']
        ],
        'visible' => true,
    ],
    [
        'attribute' => 'country_id',
        'vAlign' => 'middle',
        'width' => '250px',
        'value' => function ($model, $key, $index, $widget) {
            return $model['country']['name_ar'];
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Countries::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'select user'],
        'format' => 'raw',
        'visible' => true,
    ],
    [
        'attribute' => 'region_id',
        'vAlign' => 'middle',
        'width' => '100px',
        'value' => function ($model, $key, $index, $widget) {
            return $model['region']['name_ar'];
        },
        // 'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Regions::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'select user'],
        'format' => 'raw',
        'visible' => true,
    ],
    'address',

    [
        // 'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'status_id',
        'vAlign' => 'middle',
        'width' => '100px',
        'value' => function ($model, $key, $index, $widget) {
            return Html::a($model['status']['name_ar'], ['orders/set-status', 'id' => $model->id], ['class' => 'modelbutton column_status_'.$model->id]);
            return $model->status->name_ar;
        },
        // 'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Status::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'select status'],
        'format' => 'html',
        'visible' => true,
        // 'editableOptions'=> function ($model, $key, $index,$form) {
        //     return [
        //         'header'=>'status', 
        //         'size'=>'md',
        //         'inputType' => 'dropDownList',
        //         'data'=>ArrayHelper::map(Status::find()->all(), 'id', 'name_ar'),
        //         'formOptions'=>['action' => ['/orders/change-status','id'=>$model->id,'index'=>$index]],

        //     ];

        // },


    ],

    [
        'attribute' => 'amount_required',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => 'amount_required',
        'format' => 'raw',
        'visible' => true,
        'pageSummary' => true
    ],
    // 'total_price',
    [
        'attribute' => 'total_price',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => 'total_price',
        'format' => 'raw',
        'visible' => true,
        'pageSummary' => true
    ],
    [
        'attribute' => 'order',
        'vAlign' => 'middle',
        'width' => '450px',
        'value' => function ($model, $key, $index, $widget) {
            $orderItemString = '';
            foreach ($model->orderItems as $orderItem) {
                $type = '';
                if (count($orderItem->product->subProductCount) > 1) {
                    $type = $orderItem->subProduct->type;
                }
                $orderItemString .= ' ' . $orderItem->product->name . ' ' . $type . ' ' . Yii::t('app', 'Number') . ' ( ' . $orderItem->quantity . ' ) </br>';
            }
            return $orderItemString;
        },

        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],

        'format' => 'html',
        'visible' => true,
    ],
    //'delivery_price',
    // 'discount',

    [
        'attribute' => 'delivery_price',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => 'delivery_price',
        'format' => 'raw',
        'visible' => true,
        'pageSummary' => true
    ],

    [
        'attribute' => 'discount',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => 'discount',
        'format' => 'raw',
        'visible' => true,
        'pageSummary' => true
    ],

    [
        'attribute' => 'area_id',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => function ($model, $key, $index, $widget) {
            return $model['area']['name_ar'];
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Area::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],

        'format' => 'raw',
        'visible' => true,
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'order' => DynaGrid::ORDER_FIX_RIGHT,
        'template' => '{view},{update},{delete},{bill}',
        'buttons' => [
            'bill' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-align-center"></span>', $url, [
                    'title' => Yii::t('yii', 'Invoice'),
                ]);
            }
        ]
    ],

    ['class' => 'kartik\grid\CheckboxColumn',  'order' => DynaGrid::ORDER_FIX_RIGHT],
];




?>
<div class="orders-index">
    <?= DynaGrid::widget([
        'columns' => $columns,
        'storage' => DynaGrid::TYPE_COOKIE,
        'theme' => 'panel-success',
        'gridOptions' => [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'panel' => [
                'heading' => '<h3 class="panel-title">' . $this->title . '</h3>',
                'before' => '{dynagrid}' .  Html::a( "<span class='glyphicon glyphicon-plus' > </span>", ['create'], ['class' => 'btn btn-success' ,'title'=>Yii::t('app', 'Create_Order')]) . 
                "<button id='print_all_invoice' class='btn btn-success' title='" . Yii::t('app', 'Print_All_Invoice') . "' > <span    class='glyphicon glyphicon-print' > </span> </button>".
                "<button id='export_pdf' class='btn btn-success' title='" . Yii::t('app', 'Export_PDF') . "' > <span   class='glyphicon glyphicon-file' > </span> </button>".
                "<button id='change_status' class='btn btn-success' title='" . Yii::t('app', 'Change_Status') . "' > <span   class='glyphicon glyphicon-screenshot' > </span> </button>".
                "<button id='delete_orders' class='btn btn-success' title='" . Yii::t('app', 'Delete_Orders') . "' > <span   class='glyphicon glyphicon-trash' > </span> </button>"            ],
            'showPageSummary' => true,
        ],

        'options' => ['id' => 'dynagrid-1'] // a unique identifier is important
    ]);


    ?>



    <?php

    Modal::begin([
        'id'     => 'model',
        'size'   => 'model-lg',
    ]);

    echo "<div id='modelContent'></div>";

    Modal::end();

    ?>



</div>