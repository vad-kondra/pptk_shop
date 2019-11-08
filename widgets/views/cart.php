<?php


/* @var $this yii\web\View */
/* @var $cart Cart */

use app\helpers\PriceHelper;
use app\models\cart\Cart;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<li>
    <a class="cart-btn" href="<?=Url::to('/cart')?>"><i class="fa fa-shopping-basket"></i><span class="cart-counter">2</span></a>
    <ul class="ht-dropdown main-cart-box">
        <li>
            <?php foreach ($cart->getItems() as $item): ?>
                <?php
                $product = $item->getProduct();
                $url = Url::to(['/catalog/product', 'id' => $product->id]);
                ?>
                <!-- Cart Box Start -->
                <div class="single-cart-box">
                    <div class="cart-img">
                        <a href="#">
                            <?php if ($product->photo):?>
                                <?= Html::img('/'.$product->photo->img_src) ?>
                            <?php else: ?>
                                <?= Html::img('/images/empty-img.png') ?>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="cart-content">
                        <h6><a href="<?=$url?>"><?= Html::encode($product->name ) ?></a></h6>
                        <span>1 × <?= PriceHelper::format($item->getPrice()) ?></span>
                    </div>
                    <a class="del-icone" href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>"><i class="fa fa-window-close-o"></i></a>
                </div>
                <!-- Cart Box End -->
            <?php endforeach; ?>
            <!-- Cart Footer Inner Start -->
            <div class="cart-footer fix">
                <h5>Всего :<span class="f-right"><?= PriceHelper::format($cart->getCost()->getTotal()) ?></span></h5>
                <div class="cart-actions">
                    <a class="checkout" href="<?=Url::to('/checkout')?>">Оформить заказ</a>
                </div>
            </div>
            <!-- Cart Footer Inner End -->
        </li>
    </ul>
</li>