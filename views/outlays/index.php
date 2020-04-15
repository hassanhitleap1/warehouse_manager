<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Outlays\OutlaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$columns = [
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    'title',
    'value',
    'typeoulay.title',
    'product.name',
    'created_at',
    [
        'class'=>'kartik\grid\ActionColumn',
        'dropdown'=>false,
        'order'=>DynaGrid::ORDER_FIX_RIGHT
    ],
    ['class'=>'kartik\grid\CheckboxColumn',  'order'=>DynaGrid::ORDER_FIX_RIGHT],
];

$this->title = Yii::t('app', 'Outlays');
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
?>
<div class="outlays-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  if($session->has('message')):?>
        <div class="alert alert-success"> <?= $session->get("message") ?> </div>
        <?php  $session->remove('message');?>

    <?php endif; ?>


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
