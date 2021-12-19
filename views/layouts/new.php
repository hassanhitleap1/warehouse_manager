<?php
use app\assets\NewAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

NewAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>

    <?php include 'head_nav.php' ?>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <audio controls style="display: none" id="ringing">
            <source src="<?=  Yii::getAlias('@web')?>/sounds/bell-ringing.mp3" type="audio/mpeg">
        </audio>

        <?php include "sidebar.php"; ?>

        <!-- sidebar-wrapper  -->
        <div class="loader"></div>
        <main class="page-content">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="container-fluid">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
        <!-- page-content" -->

    </div>





    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>