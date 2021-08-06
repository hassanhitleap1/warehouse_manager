<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class  AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css ;
    public $js ;
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'airani\bootstrap\BootstrapRtlAsset',
    ];


    function __construct() {
        $path_theme="theme/adminlte-rtl";
        $this->css=[
            "$path_theme/plugins/fontawesome-free/css/all.min.css",
            "$path_theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
            "$path_theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css",
            "$path_theme/plugins/jqvmap/jqvmap.min.css",
            "$path_theme/dist/css/adminlte.min.css",
            "$path_theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
            "$path_theme/plugins/daterangepicker/daterangepicker.css",
            "$path_theme/plugins/summernote/summernote-bs4.min.css",

        ];
        $this->js=[
            "$path_theme/plugins/jquery/jquery.min.js",
            "$path_theme/plugins/jquery-ui/jquery-ui.min.js",
            "$path_theme/plugins/bootstrap/js/bootstrap.bundle.min.js",
            "$path_theme/plugins/chart.js/Chart.min.js",
            "$path_theme/plugins/sparklines/sparkline.js",
            "$path_theme/plugins/jqvmap/jquery.vmap.min.js",
            "$path_theme/plugins/jqvmap/maps/jquery.vmap.usa.js",
            "$path_theme/plugins/jquery-knob/jquery.knob.min.js",
            "$path_theme/plugins/moment/moment.min.js",
            "$path_theme/plugins/daterangepicker/daterangepicker.js",
            "$path_theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js",
            "$path_theme/plugins/summernote/summernote-bs4.min.js",
            "$path_theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
            "$path_theme/dist/js/adminlte.js",
            "$path_theme/dist/js/demo.js",
            "$path_theme/dist/js/pages/dashboard.js",
        ];
    }
}