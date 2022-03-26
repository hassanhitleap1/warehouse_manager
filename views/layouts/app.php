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
    <?php include  ("app/head.php") ?>

</head>

<body>
<?php $this->beginBody() ?>
<div id="page">
    <div class="loader"></div>
    <?php include  ("app/header.php") ?>
    <!-- /header -->

    <div class="top_panel">
        <div class="container header_panel">
            <a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
            <small><?= Yii::t('app','What are you looking for?') ?></small>
        </div>
        <!-- /header_panel -->

        <div class="container">
            <?php $form = \yii\widgets\ActiveForm::begin([ 'method' => 'get' ,'action' => 'index.php?r=site%2Fshop']); ?>

                <div class="search-input">
                    <input type="text" name="q" placeholder="<?= Yii::t('app','Search') ?>">
                    <button type="submit"><i class="ti-search"></i></button>
                </div>
            <?php \yii\widgets\ActiveForm::end(); ?>

        </div>
        <!-- /related -->
    </div>
    <!-- /search_panel -->
    <?= $content ?>

    <!-- /main -->

    <?php include("app/footer.php")?>
    <!--/footer-->
</div>
<!-- page -->

<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="<?= $path_theme ?>js/common_scripts.min.js"></script>
<script src="<?= $path_theme ?>js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="<?= $path_theme ?>js/carousel-home.js"></script>
<script src="<?= Yii::getAlias('@web')?>/js/custum.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>