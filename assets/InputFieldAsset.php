<?php
/**
 * Created by PhpStorm.
 * User: twobomb
 * Date: 01.08.2018
 * Time: 16:35
 */

namespace app\assets;


class InputFieldAsset extends AssetWrapper
{

    public $js = [
        "/js/fileinput/js/plugins/sortable.js",
        "/js/fileinput/js/fileinput.min.js",
        "/js/fileinput/js/locales/ru.js"
      ];

    public $jsOptions = [
        'position'=> \yii\web\View::POS_HEAD
    ];
    public $css = [
        "/css/fileinput/css/fileinput.min.css"
      ];
    public $depends = [
      //  'app\assets\FontAwesomeAsset'

        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}