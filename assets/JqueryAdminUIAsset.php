<?php
/**
 * Created by PhpStorm.
 * User: twobomb
 * Date: 27.06.2018
 * Time: 16:21
 */

namespace app\assets;


class JqueryAdminUIAsset extends AssetWrapper
{
    public $js=[
        "/js/admin-jquery-ui.min.js"
    ];
    public $css = [
        '/css/admin-jquery-ui/jquery-ui.min.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}