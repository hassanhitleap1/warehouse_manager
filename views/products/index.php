<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\products\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Create_Product">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create_Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            
            [
                'attribute'=>'thumbnail',
                'value' => function ($searchModel) {

                    return Html::img($searchModel->thumbnail,['width'=>'100','height'=>'100']);
    
                },
                'format' => 'html',
            ],
            'purchasing_price',
            'selling_price',
            'quantity',
            [
                'attribute' => 'category_id',
                'value' => 'category.name_ar',

            ],
           
            // 'status',
            [
                'attribute' => 'supplier_id',
                'value' => 'supplier.name_ar',

            ],
           
            [
                'attribute' => 'unit_id',
                'value' => 'unit.name_ar',

            ],
           
            [
                'attribute' => 'warehouse_id',
                'value' => 'warehouse.name',

            ],
          
            [
                'attribute'=>'quantity',
                'value' => function ($searchModel) {
                    $str="العدد الكلي " . $searchModel->quantity;  
                    foreach($searchModel->subProductCount as $subProductCount){
                        $str.="<br />".$subProductCount->type ." ".$subProductCount->count ;
                        
                    }
                
                    return  $str;
    
                },
                'format' => 'html',
            ],
            'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
