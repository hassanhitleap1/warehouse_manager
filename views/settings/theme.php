<?php

use yii\widgets\ActiveForm;



$this->title=Yii::t('app','Theme_Settings');

?>

<?php if (Yii::$app->session->has('message')) : ?>
    <div class="alert alert-success">
        <strong>Success!</strong> <?= Yii::$app->session->get('message') ?>
    </div>
<?php Yii::$app->session->remove('message') ?>
<?php endif; ?>
<div class="advertisement-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php ActiveForm::end(); ?>

</div>
