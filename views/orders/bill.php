<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\orders\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'order_id',
            // 'user_id',
               
            [
                'format' => 'raw',
                'attribute' => 'user_id',
                'label'=>Yii::t('app','Name'),
                'value' => $model['user']['name']  ,

            ],
            [
                'format' => 'raw',
                'attribute' => 'user_id',
                'label'=>Yii::t('app','Phone'),
                'value' => $model['user']['phone']  ,

            ],
            [
                'format' => 'raw',
                'attribute' => 'user_id',
                'label'=>Yii::t('app','Other_Phone'),
                'value' => $model['user']['other_phone']  ,

            ],
         
            
            'delivery_date',
            'delivery_time',
            
             
            [
                'format' => 'raw',
                'attribute' => 'order',
                'value' => function($model){
                    $order=' ';
                    foreach($model['orderItems'] as $orderItems ){
                        $order.= " ".Yii::t('app','Product')." ".$orderItems['product']['name'] ." ". Yii::t('app','Count')." ( ".$orderItems['quantity'] ." )"; 
                    }
                    return $order;
                } ,

            ],
            // [
            //     'format' => 'raw',
            //     'attribute' => 'country_id',
            //     'value' =>  $model['country']['name_ar'],

            // ],
           
            
             
            [
                'format' => 'raw',
                'attribute' => 'region_id',
                'value' =>  $model['region']['name_ar'],

            ],
           
           
            [
                'format' => 'raw',
                'attribute' => 'area_id',
                'value' =>  $model['area']['name_ar'],

            ],
            
             
            // [
            //     'format' => 'raw',
            //     'attribute' => 'status_id',
            //     'value' =>  $model['status']['name_ar'],

            // ],
           
            'address',
            
            [
                'format' => 'raw',
                'attribute' => 'status_id',
                'value' =>  $model['status']['name_ar'],

            ],
           
            'created_at',
            // 'updated_at',
        ],
    ]) ?>

</div>
