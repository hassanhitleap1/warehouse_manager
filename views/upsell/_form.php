<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\upsell\Upsell */
/* @var $form yii\widgets\ActiveForm */
$products =\yii\helpers\ArrayHelper::map(\app\models\products\Products::find()->all(), 'id', 'name');

?>

<div class="upsell-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'product_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => $products,
        'language' => 'ar',
        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
    ]); ?>


    <?= $form->field($model,"list_product_id")->widget(\kartik\select2\Select2::classname(), [
        'data' => $products,
        'language' => 'ar',
        'options' => ['multiple' => true,'placeholder' =>Yii::t('app',"Plz_Select"),'class'=>''],

    ]); ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
