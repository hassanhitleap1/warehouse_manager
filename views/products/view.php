<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\products\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

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
        <?= Html::a('<span class="glyphicon glyphicon-log-out"></span>', ['product/view','id'=>$model->id], ['class' => 'btn btn-success','target'=>'_blank']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
           
            [
                'attribute'=>'thumbnail',
                'value'=> Yii::getAlias('@web') . '/' .$model->thumbnail,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'purchasing_price',
            'selling_price',
            'quantity',
            
            [
                'format' => 'raw',
                'attribute' => 'category_id',
                'value' =>  $model['category']['name_ar'],

            ],

            [
                'format' => 'raw',
                'attribute' => 'supplier_id',
                'value' => isset($model['supplier'])? $model['supplier']['name']:'',

            ],
            [
                'format' => 'raw',
                'attribute' => 'unit_id',
                'value' =>  $model['unit']['name_ar'], 
            ],
            [
                'format' => 'raw',
                'attribute' => 'warehouse_id',
                'value' =>  $model['warehouse']['name'],
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
