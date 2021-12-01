<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
 <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?php $this->registerCsrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/dist/css/custom.css">







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

<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/moment/moment.min.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/dist/js/adminlte.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/plugins/jqvmap/jquery.vmap.js"></script>

<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/dist/js/pages/dashboard.js"></script>
<!-- theme/adminlte for demo purposes -->
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/dist/js/demo.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
$this->beginPage() ?>