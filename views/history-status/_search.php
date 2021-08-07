<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model app\models\historystatus\HistoryStatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-status-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
        
        <label class="control-label"><?=Yii::t('app','Created_At')?></label>
                <?= DateRangePicker::widget([
                    'model'=>$model,
                    'language' => 'en',
                    'attribute'=>'created_at',
                    'readonly'=>true,
                    'convertFormat'=>true,
                    'options' => ['class' => 'form-control' ,"autocomplete"=>"off" ,"autocomplete"=>"no-fill"],
                    'pluginOptions'=>[
                        'timePicker'=>true,
                        'timePickerIncrement'=>30,
                        'locale'=>[
                            'format'=>'Y-m-d'
                        ]
                    ]
                ]);

                ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary search_order']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), ['/history-status'],['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
