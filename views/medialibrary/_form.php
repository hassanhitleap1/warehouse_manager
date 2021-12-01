<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\medialibrary\Medialibrary */
/* @var $form yii\widgets\ActiveForm */

   $dataImages = [

        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ];

?>

<div class="medialibrary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'media[]')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'multiple' => true],
                'pluginOptions' => $dataImages
            ]);?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
