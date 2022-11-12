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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "malefashion-master/css/bootstrap.min.css",
        "malefashion-master/css/font-awesome.min.css",
        "malefashion-master/css/elegant-icons.css",
        "malefashion-master/css/magnific-popup.css",
        "malefashion-master/css/nice-select.css",
        "malefashion-master/css/owl.carousel.min.css",
        "malefashion-master/css/slicknav.min.css",
        "malefashion-master/css/style.css",

    ];
    public $js = [
        "malefashion-master/js/jquery-3.3.1.min.js",
        "malefashion-master/js/bootstrap.min.js",
        "malefashion-master/js/jquery.nice-select.min.js",
        "malefashion-master/js/jquery.nicescroll.min.js",
        "malefashion-master/js/jquery.magnific-popup.min.js",
        "malefashion-master/js/jquery.countdown.min.js",
        "malefashion-master/js/jquery.slicknav.js",
        "malefashion-master/js/mixitup.min.js",
        "malefashion-master/js/owl.carousel.min.js",
        "malefashion-master/js/main.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
