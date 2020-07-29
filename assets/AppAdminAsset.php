<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\View;

class AppAdminAsset extends AssetWrapper
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [
        "css/admin/admin.css",

    ];
    public $js = [
        "js/admin.js",
    ];

    public $jsOptions = [
        'position'=> View::POS_END
    ];

    public $cssOptions = [
        'position'=> View::POS_BEGIN
    ];

    public $depends = [
        '\rmrevin\yii\ionicon\AssetBundle'
    ];
}
