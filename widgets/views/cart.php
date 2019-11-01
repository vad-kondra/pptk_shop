<?php


/* @var $this yii\web\View */
/* @var $cart Cart */

use app\helpers\PriceHelper;
use app\models\cart\Cart;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<div class="cart-dropdown header-link-dropdown">
    <?php if(count($cart->getItems()) > 0): ?>
<!--        <ul class="cart-list link-dropdown-list">-->
<!---->
<!--            --><?php //foreach($cart->getItems() as $key => $item): ?>
<!--                --><?php
//                $product = $item->getProduct();
//                $url = Url::to(['/catalog/product', 'id' => $product->id]);
//                if ($key == 5) break;
//                ?>
<!--                <li> <a class="close-cart" href="--><?//= Url::to(['/cart/remove', 'id' => $item->getId()]) ?><!--" data-method="post"><i class="fa fa-times-circle"></i></a>-->
<!--                    <div class="media">-->
<!--                        <a class="pull-left" href="--><?//= $url ?><!--">-->
<!--                            --><?php //if ($product->photo):?>
<!--                                --><?//= Html::img('/'.$product->photo->img_src) ?>
<!--                            --><?php //else: ?>
<!--                                --><?//= Html::img('/images/empty-img.png') ?>
<!--                            --><?php //endif; ?>
<!--                        </a>-->
<!--                        <div class="media-body cart-item-name"> <span><a href="--><?//= $url ?><!--">--><?//= Html::encode(substr($product->name, 0, 30)) ?><!--</a></span>-->
<!--                            <p class="cart-price">--><?//= PriceHelper::format($item->getPrice()) ?><!--</p>-->
<!--                            <div class="product-qty">-->
<!--                                <label>Количество:</label>-->
<!--                                <div class="custom-qty">-->
<!--                                    --><?//= $item->getQuantity() ?>
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--            --><?php //endforeach; ?>
<!---->
<!--        </ul>-->
        <p class="cart-sub-totle"> <span class="pull-left">Итого в корзине <strong><?=count($cart->getItems())?></strong> товара(ов) на сумму </span> <span class="pull-right"><strong class="price-box"><?= PriceHelper::format($cart->getCost()->getTotal()) ?></strong></span> </p>
        <div class="clearfix"></div>
        <div class="mt-20"> <a href="<?=\yii\helpers\Url::to('/cart')?>" class="btn-color btn">Корзина</a> <a href="<?=\yii\helpers\Url::to('/checkout')?>" class="btn-color btn right-side">Оформить</a> </div>

    <?php else: ?>
        <div align="center">В вашей корзине нет товаров</div>
    <?php endif; ?>
</div>
