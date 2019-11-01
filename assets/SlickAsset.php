<?php
/**
 * Created by PhpStorm.
 * User: Stewi
 * Date: 21.01.2019
 * Time: 0:12
 */

namespace app\assets;


class SlickAsset extends AssetWrapper{
    public $css = [

        'css/slick/slick.css',
        'css/slick/slick-theme.css',
        'css/slick/slick-1.css',
        'css/slick/slider.css',//чето помойму дохрена стилей, там 1 обычно идет
    ];
    public $js = [

        'js/slick/slick.js',
    ];


    public $depends = [
        'yii\web\JqueryAsset'
    ];
}