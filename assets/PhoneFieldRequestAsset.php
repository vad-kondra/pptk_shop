<?php
/**
 * Created by PhpStorm.
 * User: emrissol
 * Date: 06-Dec-18
 * Time: 10:15 PM
 */

namespace app\assets;


class PhoneFieldRequestAsset extends AssetWrapper
{
    public $css = [
        "/css/intl-tel/intlTelInput.min.css"
    ];
    public $js = [
        "/js/intl-tel/intlTelInput.min.js",
        "/js/intl-tel/utils.js",
        "/js/phoneValidationRequest.js"
    ];

}