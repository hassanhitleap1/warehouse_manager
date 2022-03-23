<?php
use yii\helpers\Html;
$path_theme= Yii::getAlias('@web').'theme/shop/'
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
        <?php $this->head() ?>
    
        <?php include("app/head.php")?>
    </head>

    <body>
    <?php $this->beginBody() ?>

    <div class="wrap" id="page">


        <div class="loader"></div>



        <?php include("app/header.php")?>

        <?php include("app/top_panel.php")?>

            <?= $content ?>

        <?php include("app/footer.php")?>

    </div>

    <div id="toTop"></div><!-- Back to top button -->

    <!-- COMMON SCRIPTS -->
    <script src="<?= $path_theme ?>js/common_scripts.min.js"></script>
    <script src="<?= $path_theme ?>js/main.js"></script>
    <script src="<?= $path_theme ?>js/main.js"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script src="<?= Yii::getAlias('@web')?>/js/custum.js"></script>



    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>