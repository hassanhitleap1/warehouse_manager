<?php

use app\assets\AdminLteAsset;
use yii\helpers\Html;


AdminLteAsset::register($this);
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


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= include ("sections_adminrte/main-header.php");?>

    <?= include ("sections_adminrte/main-sidebar.php");?>

    <?= include ("sections_adminrte/content-wrapper.php");?>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.0-rc.1
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
$this->beginPage() ?>