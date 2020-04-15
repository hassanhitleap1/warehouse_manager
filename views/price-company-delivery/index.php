<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
/* @var $this yii\web\View */
/* @var $searchModel app\models\pricecompanydelivery\PriceCompanyDeliverySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Price Company Deliveries');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    'region_id',
    'company_delivery_id',
    'price',
    [
        'class'=>'kartik\grid\ActionColumn',
        'dropdown'=>false,
        'order'=>DynaGrid::ORDER_FIX_RIGHT
    ],
    ['class'=>'kartik\grid\CheckboxColumn',  'order'=>DynaGrid::ORDER_FIX_RIGHT],
];


?>
<div class="price-company-delivery-index">

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
                'before'=>'{dynagrid}' . Html::a(Yii::t('app', 'Create_Area'), ['create'], ['class' => 'btn btn-success'])
            ],

        ],

        'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
    ]);


    ?>




</div>
