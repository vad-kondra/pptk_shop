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
        //'css/bootstrap.css',
        'css/jquery-ui.css',
        'css/owl.carousel.css',
        'css/fotorama.css',
        'css/magnific-popup.css',
        'css/custom.css',
        'css/responsive.css'
    ];
    public $js = [
        //"js/jquery-1.12.3.min.js",
        //'js/bootstrap.min.js',
        "js/jquery.downCount.js",
        'js/jquery-ui.min.js',
        "js/fotorama.js",
        "js/jquery.magnific-popup.js",
        "js/owl.carousel.min.js",
        "js/custom.js",
    ];

    public $jsOptions = [
        'position'=> View::POS_END
    ];

    public $cssOptions = [
        'position'=> View::POS_BEGIN
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\FontAwesomeAsset',
        'app\assets\MyBootstrapAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\ionicon\AssetBundle'
    ];
}
