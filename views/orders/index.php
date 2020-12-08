<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\area\Area;
use app\models\countries\Countries;
use app\models\regions\Regions;
use app\models\status\Status;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\orders\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'user_id',
            'delivery_date',
            'delivery_time',
//             'country_id',
            
                 [
                'attribute' => 'country_id',
                'value' => 'country.name_ar',
                'filter' =>Select2::widget([
                    'name' => 'category_id',
                    "value"=>(isset($_GET['country_id']))?$_GET['country_id']:null,
                    'data' => ArrayHelper::map(Countries::find()->all(), 'id', 'name_ar'),
                    'options' => [
                        'placeholder' => 'Select  ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',

            ],
            
//             'region_id',
            
            
               [
                'attribute' => 'region_id',
                'value' => 'region.name_ar',
                'filter' =>Select2::widget([
                    'name' => 'category_id',
                    "value"=>(isset($_GET['region_id']))?$_GET['region_id']:null,
                    'data' => ArrayHelper::map(Area::find()->all(), 'id', 'name_ar'),
                    'options' => [
                        'placeholder' => 'Select  ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',

            ],
            
//             'area_id',
                 [
                'attribute' => 'area_id',
                'value' => 'area.name_ar',
                'filter' =>Select2::widget([
                    'name' => 'category_id',
                    "value"=>(isset($_GET['area_id']))?$_GET['area_id']:null,
                    'data' => ArrayHelper::map(Area::find()->all(), 'id', 'name_ar'),
                    'options' => [
                        'placeholder' => 'Select  ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',

            ],
            
            'address',
//             'status_id',
            
              [
                'attribute' => 'status_id',
                'value' => 'status.name_ar',
                'filter' =>Select2::widget([
                    'name' => 'category_id',
                    "value"=>(isset($_GET['status_id']))?$_GET['status_id']:null,
                    'data' => ArrayHelper::map(Status::find()->all(), 'id', 'name_ar'),
                    'options' => [
                        'placeholder' => 'Select  ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',

            ],
            
            
            
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
