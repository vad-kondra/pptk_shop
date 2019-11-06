<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\View;

class AppAsset extends AssetWrapper
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [
        "css/meanmenu.min.css",
        "css/animate.css",
        "css/nivo-slider.css",
        "css/owl.carousel.min.css",
        "css/slick.css",
        "css/jquery-ui.min.css",
        "css/font-awesome.min.css",
        "css/jquery.fancybox.css",
        "css/bootstrap.min.css",
        "css/default.css",
        "css/style.css",
        "css/responsive.css",

    ];
    public $js = [
        "js/vendor/jquery-1.12.4.min.js",
        "js/jquery.meanmenu.min.js",
        "js/jquery.scrollUp.js",
        "js/owl.carousel.min.js",
        "js/slick.min.js",
        "js/wow.min.js",
        "js/jquery-ui.min.js",
        "js/jquery.countdown.min.js",
        "js/jquery.nivo.slider.js",
        "js/jquery.fancybox.min.js",
        "js/bootstrap.min.js",
        "js/popper.js",
        "js/plugins.js",
        "js/main.js",
    ];

    public $jsOptions = [
        'position'=> View::POS_END
    ];

    public $cssOptions = [
        'position'=> View::POS_BEGIN
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'app\assets\FontAwesomeAsset',
        //'app\assets\MyBootstrapAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'\rmrevin\yii\ionicon\AssetBundle'
    ];
}
