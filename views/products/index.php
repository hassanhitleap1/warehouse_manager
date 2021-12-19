<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use yii\widgets\Pjax;
use app\models\categorises\Categorises;
use app\models\suppliers\Suppliers;
//use app\models\units\Units;
use app\models\warehouse\Warehouse;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;



$columns = [

    [
        'class' => 'kartik\grid\SerialColumn',
        'order' => DynaGrid::ORDER_FIX_LEFT,

    ],
    [

        'attribute' => 'name',
        'value'=>function ($searchModel) {
            return Html::a($searchModel['name'] ,['sub-product-count/index','product_id'=>$searchModel->id]);
        },
        'contentOptions' => ['class' => 'name'],
        'format'=>'html'
    ],
    [
        'attribute'=>'thumbnail',
        'value' => function ($searchModel) {
            return Html::img($searchModel->thumbnail,['width'=>'100','height'=>'100']);
        },
        'format' => 'html',
    ],
    [
        'attribute'=>'purchasing_price',
        'value' => function ($searchModel) {
            return    Html::a( $searchModel->purchasing_price,['products/change-purchasing-price','id'=>$searchModel->id ],["class"=>"open_model"]);;
        },
        'contentOptions' => ['class' => 'purchasing_price'],
        'format' => 'html',
    ],

    [
        'attribute'=>'selling_price',
        'value' => function ($searchModel) {
            return    Html::a( $searchModel->selling_price,['products/change-selling-price','id'=>$searchModel->id ],["class"=>"open_model"]);;
        },
        'contentOptions' => ['class' => 'selling_price'],
        'format' => 'html',
    ],

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
        'contentOptions' => ['class' => 'category_id'],
        'format' => 'html',
    ],



    [
        'attribute'=>'quantity',
        'value' => function ($searchModel) {
            $str="العدد الكلي " . $searchModel->quantity;
            if(count($searchModel->subProductCount) > 1){
                foreach($searchModel->subProductCount as $subProductCount){
                    $str.="<br />".$subProductCount->type ." ".$subProductCount->count ;

                }
            }
            return    Html::a( $str,['products/change-total','id'=>$searchModel->id ],["class"=>"open_model"]);;
        },
        'contentOptions' => ['class' => 'quantity'],
        'format' => 'html',
    ],

    [
        'attribute' =>'type_options',
        'value'=>function($searchModel){
            $str='';
            if(count($searchModel->typeOptions ))
            {
                foreach ($searchModel->typeOptions as $type_option)
                {
                    $str.=$type_option->text .'  <br />' ;
                }
            }

            return    Html::a($str,['options-sell-product/index','product_id'=>$searchModel->id]);;
        },
        'format' => 'html',
        'headerOptions' => ['style' => 'width:20%'],
    ],
    [
        'attribute'=>'quantity_come',
        'value' => function ($searchModel) {
            return    Html::a( $searchModel->quantity_come,['products/change-quantity-come','id'=>$searchModel->id ],["class"=>"open_model"]);;
        },
        'contentOptions' => ['class' => 'quantity_come'],
        'format' => 'html',
    ],


    ['class' => 'kartik\grid\CheckboxColumn',  'order' => DynaGrid::ORDER_FIX_RIGHT],
];



/* @var $this yii\web\View */
/* @var $searchModel app\models\products\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Create_Product">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>

    <?= DynaGrid::widget([
        'columns' => $columns,
        'storage' => DynaGrid::TYPE_COOKIE,
        'theme' => 'panel-success',
        'gridOptions' => [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'panel' => [
                'heading' => '<h3 class="panel-title">' . $this->title . '</h3>',
                'before' => '{dynagrid}' .  Html::a( "<span class='glyphicon glyphicon-plus' > </span>", ['create'], ['class' => 'btn btn-success' ,'title'=>Yii::t('app', 'Create')])
            ],
            'showPageSummary' => true,
        ],

        'options' => ['id' => 'dynagrid'],  // a unique identifier is important

    ]);


    ?>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?php Pjax::end(); ?>


    <?php

    Modal::begin([
        'id'     => 'model',
        'size'   => 'model-lg',
    ]);

    echo "<div id='modelContent'></div>";

    Modal::end();

    ?>
</div>
