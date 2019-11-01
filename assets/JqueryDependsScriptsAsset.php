<?php
/**
 * Created by PhpStorm.
 * User: Stewi
 * Date: 21.01.2019
 * Time: 0:14
 */

namespace app\assets;


class JqueryDependsScriptsAsset extends AssetWrapper
{
    public $css = [

        'css/jquery.mCustomScrollbar.css',
    ];

    public $js = [

        'js/select/js/select.js',
        'js/fileinput/js/fileinput.js',
        'js/maskedinput/jquery.maskedinput.min.js',
        //'js/scroll/jquery.mCustomScrollbar.concat.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

}