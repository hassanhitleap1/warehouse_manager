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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            'user_id',
               
            [
                'format' => 'raw',
                'attribute' => 'user_id',
                'value' => Yii::t('app','Name').": ". $model['user']['name'] ."  ".Yii::t('app','Phone')." : ".$model['user']['phone']."  ".Yii::t('app','Other_Phone')." : ".$model['user']['other_phone'] ,

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
            [
                'format' => 'raw',
                'attribute' => 'country_id',
                'value' =>  $model['country']['name_ar'],

            ],
           
            
             
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
            
             
            [
                'format' => 'raw',
                'attribute' => 'status_id',
                'value' =>  $model['status']['name_ar'],

            ],
           
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
