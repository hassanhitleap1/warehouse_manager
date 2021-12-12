<?php

use yii\widgets\ActiveForm;


use kartik\color\ColorInput;

$this->title=Yii::t('app','Theme_Settings');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Theme_Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->has('message')) : ?>
    <div class="alert alert-success">
        <strong>Success!</strong> <?= Yii::$app->session->get('message') ?>
    </div>
<?php Yii::$app->session->remove('message') ?>
<?php endif; ?>
<div class="advertisement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'color_site')->widget(ColorInput::classname(), [
            'options' => ['placeholder' => 'Select color ...','value'=>$params['color_site']],
        ]);?>


    <?=  $form->field($model, 'font_color')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'Select color ...','value'=>$params['font_color']],
    ]);?>
    <?=  $form->field($model, 'background_duration')->dropDownList(
                ['to right' => 'to right', 'to left' => 'to left'],
                ['options' => ['placeholder' => 'Select color ...','value'=>$params['background_duration']]]
        ); ?>
    <?=  $form->field($model, 'background_first_color')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'font_color color ...','value'=>$params['background_first_color']],
    ]);?>

    <?=  $form->field($model, 'background_second_color')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'font_color color ...','value'=>$params['background_second_color']],
    ]);?>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
