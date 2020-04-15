<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\medialibrary\MedialibrarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Medialibraries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medialibrary-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Medialibrary'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            [
                'attribute'=>'copy',
                'value' => function ($searchModel) {
                    return '<span class="glyphicon glyphicon-copy" attr_copy="'.$searchModel->path.'"></span>';
                },
                'format' => 'html',
            ],
            [
                'attribute'=>'path',
                'value' => function ($searchModel) {
                    return Html::img($searchModel->path,['width'=>'100','height'=>'100']);
                },
                'format' => 'html',
            ],
            'extension',
//            'created_at',
            //'updated_at',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{view}{delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
