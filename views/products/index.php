<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\categorises\Categorises;
use app\models\suppliers\Suppliers;
use app\models\units\Units;
use app\models\warehouse\Warehouse;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


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
            [
                
                'attribute' => 'name',
                'value'=>function ($searchModel) {
                    return Html::a($searchModel['name'] ,['sub-product-count/index','product_id'=>$searchModel->id]);
                },
                'format'=>'html'
            ],
           
            
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
                'filter' =>Select2::widget([
                    'name' => 'category_id',
                    "value"=>(isset($_GET['category_id']))?$_GET['category_id']:null,
                    'data' => ArrayHelper::map(Categorises::find()->all(), 'id', 'name_ar'),
                    'options' => [
                        'placeholder' => 'Select  ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',

            ],
           
            // 'status',
            [
                'attribute' => 'supplier_id',
                'value' => 'supplier.name',
                    'filter' =>Select2::widget([
                    'name' => 'supplier_id',
                    "value"=>(isset($_GET['supplier_id']))?$_GET['supplier_id']:null,
                    'data' => ArrayHelper::map(Suppliers::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select  ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',
                

            ],
           
            [
                'attribute' => 'unit_id',
                'value' => 'unit.name_ar',
                
                 'filter' =>Select2::widget([
                    'name' => 'unit_id',
                    "value"=>(isset($_GET['unit_id']))?$_GET['unit_id']:null,
                    'data' => ArrayHelper::map(Units::find()->all(), 'id', 'name_ar'),
                    'options' => [
                        'placeholder' => 'Select  ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',
                

            ],
           
            [
                'attribute' => 'warehouse_id',
                'value' => 'warehouse.name',
                'filter' =>Select2::widget([
                    'name' => 'warehouse_id',
                    "value"=>(isset($_GET['warehouse_id']))?$_GET['warehouse_id']:null,
                    'data' => ArrayHelper::map(Warehouse::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select  ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',
                

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
