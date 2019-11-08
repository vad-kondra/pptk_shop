<?php


/* @var $this yii\web\View */
/* @var $cart Cart */

use app\helpers\PriceHelper;
use app\models\cart\Cart;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<li>
    <a class="cart-btn" href="<?=Url::to('/cart')?>"><i class="fa fa-shopping-basket"></i><span class="cart-counter">0</span></a>
    <ul class="ht-dropdown main-cart-box">

    </ul>
</li>