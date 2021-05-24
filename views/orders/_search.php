<?php

use kartik\daterange\DateRangePicker;

use yii\helpers\Html;
use yii\widgets\ActiveForm;



    
    

/* @var $this yii\web\View */
/* @var $model app\models\orders\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= DateRangePicker::widget([
        'model'=>$model,
        'attribute'=>'datetime_range',
        'convertFormat'=>true,
        'pluginOptions'=>[
            'timePicker'=>true,
            'timePickerIncrement'=>30,
            'locale'=>[
                'format'=>'Y-m-d h:i A'
            ]
        ]
    ]);

    ?>







  

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
