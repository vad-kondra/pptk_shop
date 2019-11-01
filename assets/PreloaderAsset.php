<?php
/**
 * Created by PhpStorm.
 * User: Stewi
 * Date: 21.01.2019
 * Time: 0:12
 */

namespace app\assets;


class PreloaderAsset extends AssetWrapper{
    public $css = [

        'lib/preloader/style.css',
    ];
    public $js = [
        'lib/preloader/script.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}