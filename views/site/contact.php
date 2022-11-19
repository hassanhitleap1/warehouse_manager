<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111551.9926412813!2d-90.27317134641879!3d38.606612219170856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1597926938024!5m2!1sen!2sbd" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>America</h4>
                            <p>195 E Parker Square Dr, Parker, CO 801 <br />+43 982-314-0958</p>
                        </li>
                        <li>
                            <h4>France</h4>
                            <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+12 345-423-9893</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) : ?>
                        <div class="alert alert-success">
                            Thank you for contacting us. We will respond to you as soon as possible.
                        </div>

                        <p>
                            Note that if you turn on the Yii debugger, you should be able
                            to view the mail message on the mail panel of the debugger.
                            <?php if (Yii::$app->mailer->useFileTransport) : ?>
                                Because the application is in development mode, the email is not sent but saved as
                                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                                application component to be false to enable email sending.
                            <?php endif; ?>
                        </p>

                    <?php else : ?>


                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'subject') ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>