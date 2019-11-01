<?php
/**
 * Created by PhpStorm.
 * User: Stewi
 * Date: 04.02.2019
 * Time: 11:25
 */

namespace app\assets;


class PopupAsset extends AssetWrapper
{
    public $js = [
        'lib/popup/jquery.magnific-popup.min.js',
    ];
    public $css = [
        'lib/popup/magnific-popup.css',

    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}