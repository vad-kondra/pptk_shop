<?php
/**
 * Created by PhpStorm.
 * User: twobomb
 * Date: 24.09.2018
 * Time: 20:26
 */

namespace app\assets;


class PhoneFieldAsset extends AssetWrapper
{
    public $css = [
        "/css/intl-tel/intlTelInput.min.css"
    ];
    public $js = [
        "/js/intl-tel/intlTelInput.min.js",
        "/js/intl-tel/utils.js",
    ];

}