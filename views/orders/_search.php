<?php
use kartik\field\FieldRange;
use kartik\form\ActiveForm as FormActiveForm;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


    
    

/* @var $this yii\web\View */
/* @var $model app\models\orders\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = FormActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    

    <?=   FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => 'Enter start and end points',
            'attribute1' => 'start',
            'attribute2' => 'end',
            'type' => FieldRange::INPUT_TEXT,
    ]);
        ?>





  

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
