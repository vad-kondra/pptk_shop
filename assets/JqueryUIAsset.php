<?php
/**
 * Created by PhpStorm.
 * User: twobomb
 * Date: 27.06.2018
 * Time: 16:21
 */

namespace app\assets;


class JqueryUIAsset extends AssetWrapper
{
    public $js=[
        "/js/jquery-ui.min.js"
    ];

    public $css = [
        '/css/jquery-ui.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}