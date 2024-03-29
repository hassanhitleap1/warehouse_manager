<?php

use app\models\area\Area;
use app\models\companydelivery\CompanyDelivery;
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
/* skip-export add class to export */
$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$status = ArrayHelper::map(Status::find()->all(), 'id', 'name_ar');


$columns = [


    [
        'class' => 'kartik\grid\SerialColumn',
        'order' => DynaGrid::ORDER_FIX_LEFT,

    ],

    [
        'attribute' => 'order_id',
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
        'visible' => false,
        'value' => 'order_id'
    ],



    [
        'attribute' => 'created_at',
        'format' => 'raw',
        'width' => '100px',
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
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

        //        'contentOptions' => ['class' => 'skip-export'],
        //        'headerOptions' => ['class' => 'skip-export'],
        //        'footerOptions' => ['class' => 'skip-export'],
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
        'visible' => false,

        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
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
        'visible' => false,
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
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
        //        'contentOptions' => ['class' => 'skip-export'],
        //        'headerOptions' => ['class' => 'skip-export'],
        //        'footerOptions' => ['class' => 'skip-export'],
    ],
    'address',

    [
        // 'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'status_id',
        'vAlign' => 'middle',
        'width' => '30px',
        'value' => function ($model, $key, $index, $widget) {
            return Html::a($model['status']['name_ar'], ['orders/set-status', 'id' => $model->id], ['class' => 'modelbutton column_status_' . $model->id]);
            return $model->status->name_ar;
        },
        // 'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Status::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        //'filterInputOptions' => ['placeholder' => 'select status'],
        'format' => 'html',
        'visible' => true,
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
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
        'value' => function ($model, $key, $index, $widget) {

            switch ($model->status_id) {
                case 13:
                case 6:
                    return  0;
                case 14:
                    return  -1 * $model->delivery_price;
                    break;
                case 7:
                    return  -1 * $model->amount_required;
                    break;
                default:
                    return $model->amount_required;
            }
        },
        'format' => 'raw',
        'visible' => true,
        'pageSummary' => true,
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
    ],
    // 'total_price',
    [
        'attribute' => 'total_price',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => function ($model, $key, $index, $widget) {

            switch ($model->status_id) {
                case 13:
                case 14:
                case 6:
                    return  0;
                    break;
                case 7:
                    return  -1 * $model->total_price;
                    break;
                default:
                    return $model->total_price;
            }
        },
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
                if (isset($orderItem->product->subProductCount) && count($orderItem->product->subProductCount) > 1) {
                    $type = $orderItem->subProduct->type;
                }
                $orderItemString .= ' ' . $orderItem['product']['name'] . ' ' . $type . ' ' . Yii::t('app', 'Number') . ' ( ' . $orderItem->quantity . ' ) </br>';
            }
            return $orderItemString;
        },

        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],

        'format' => 'html',
        'visible' => true,
        //        'contentOptions' => ['class' => 'skip-export'],
        //        'headerOptions' => ['class' => 'skip-export'],
        //        'footerOptions' => ['class' => 'skip-export'],
    ],
    'note',
    // 'profit_margin',
    //'delivery_price',
    // 'discount',


    [
        'attribute' => 'delivery_price',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => 'delivery_price',
        'format' => 'raw',
        'visible' => true,
        'pageSummary' => true,
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
    ],

    [
        'attribute' => 'discount',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => 'discount',
        'format' => 'raw',
        'visible' => true,
        'pageSummary' => true,
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
    ],

    [
        'attribute' => 'area_id',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => function ($model, $key, $index, $widget) {
            return  isset($model['area']) ? $model['area']['name_ar'] : '';
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Area::find()->orderBy('name_ar')->asArray()->all(), 'id', 'name_ar'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
        'format' => 'raw',
        'visible' => true,
    ],



    [


        'attribute' => 'company_delivery_id',
        'vAlign' => 'middle',
        'width' => '50px',
        'value' => function ($model, $key, $index, $widget) {
            // return $model["company_delivery_id"];
            return Html::a(isset($model['company']) ? $model['company']['name'] : '', ['orders/set-campany', 'id' => $model->id], ['class' => 'modelbutton column_campany_' . $model->id]);
            return $model['company']['name'];
        },
        'filterInputOptions' => ['placeholder' => 'select campany'],
        // 'filterType' => GridView::FILTER_SELECT2,

        'filter' => ArrayHelper::map(CompanyDelivery::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'contentOptions' => ['class' => 'skip-export'],
        'headerOptions' => ['class' => 'skip-export'],
        'footerOptions' => ['class' => 'skip-export'],
        'format' => 'raw',
        'visible' => true,
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'order' => DynaGrid::ORDER_FIX_RIGHT,
        'template' => '{view},{update},{delete},{bill}{history-status}',
        'buttons' => [
            'bill' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-align-center"></span>', $url, [
                    'title' => Yii::t('yii', 'Invoice'),
                ]);
            },
            'history-status' => function ($url, $model) {

                return Html::a(
                    '<span class="glyphicon glyphicon-calendar"></span>',
                    ['history-status/index', 'order_id' => $model->id],
                    ['class' => 'profile-link']
                );
            },
        ]
    ],

    ['class' => 'kartik\grid\CheckboxColumn',  'order' => DynaGrid::ORDER_FIX_RIGHT],
];


$session = Yii::$app->session;

?>
<div class="orders-index">


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if ($session->has('message')) : ?>
        <div class="alert alert-success"> <?= $session->get("message") ?> </div>
        <?php $session->remove('message'); ?>

    <?php endif; ?>

    <?= DynaGrid::widget([
        'columns' => $columns,
        'storage' => DynaGrid::TYPE_COOKIE,
        'theme' => 'panel-success',
        'gridOptions' => [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'panel' => [
                'heading' => '<h3 class="panel-title">' . $this->title . '</h3>',
                'before' => '{dynagrid}' .  Html::a("<span class='glyphicon glyphicon-plus' > </span>", ['create'], ['class' => 'btn btn-success', 'title' => Yii::t('app', 'Create_Order')]) .
                    "<button id='print_all_invoice' style='display: none;' class='btn btn-success' title='" . Yii::t('app', 'Print_All_Invoice') . "' > <span    class='glyphicon glyphicon-print' > </span> </button>" .
                    "<button id='export_pdf' class='btn btn-success' title='" . Yii::t('app', 'Export_PDF') . "' > <span   class='glyphicon glyphicon-print' > </span> </button>" .
                    "<button id='change_status' class='btn btn-success' title='" . Yii::t('app', 'Change_Status') . "' > <span   class='glyphicon glyphicon-screenshot' > </span> </button>" .
                    "<button id='change_campany' class='btn btn-success' title='" . Yii::t('app', 'Change_Campany') . "' > <span   class='glyphicon glyphicon-bed' > </span> </button>" .
                    "<button id='export_to_driver' class='btn btn-success' title='" . Yii::t('app', 'Export_To_Driver') . "' > <span   class='glyphicon glyphicon-plane' > </span> </button>" .
                    "<button id='delete_orders' class='btn btn-success' title='" . Yii::t('app', 'Delete_Orders') . "' > <span   class='glyphicon glyphicon-trash' > </span> </button>"
            ],
            'showPageSummary' => true,
        ],

        'options' => ['id' => 'dynagrid'],  // a unique identifier is important

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