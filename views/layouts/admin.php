<?php

use app\assets\AdminAsset;
use yii\helpers\Html;


AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?php $this->registerCsrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php $this->beginBody() ?>
<div class="wrapper">

    <!-- Preloader -->
    <?= include ("sections/preloader.php");?>

    <!-- Navbar -->
    <?= include ("sections/navbar.php");?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= include ("sections/sidebar.php");?>

    <!-- Content Wrapper. Contains page content -->
    <?= include ("sections/content-wrapper.php");?>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
