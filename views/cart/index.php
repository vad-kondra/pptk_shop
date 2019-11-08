<?php

/* @var $this yii\web\View */
/* @var $cart Cart */

use app\helpers\PriceHelper;
use app\models\cart\Cart;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;

$count = count($cart->getItems());

?>
<!-- Cart Main Area Start -->
<div class="cart-main-area pb-80 pb-sm-50">
    <div class="container">
        <h2 class="text-capitalize sub-heading">Корзина</h2>
        <div class="row">
            <div class="col-md-12">
                <!-- Form Start -->
                <form action="#">
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive mb-50">
                        <table>
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Изображение</th>
                                <th class="product-name">Название</th>
                                <th class="product-price">Цена</th>
<!--                                <th class="product-quantity">Количество</th>-->
<!--                                <th class="product-subtotal">Всего</th>-->
                                <th class="product-remove">Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($count > 0): ?>

                                <?php foreach ($cart->getItems() as $item): ?>
                                <?php
                                $product = $item->getProduct();
                                $url = Url::to(['/catalog/product', 'id' => $product->id]); ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="<?=$url?>">
                                                <?php if ($product->photo):?>
                                                    <?= Html::img('/'.$product->photo->img_src) ?>
                                                <?php else: ?>
                                                    <?= Html::img('/images/empty-img.png') ?>
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        <td class="product-name"><a href="<?=$url?>"><?= Html::encode($product->name) ?></a></td>
                                        <td class="product-price"><span class="amount"><?= PriceHelper::format($item->getPrice()) ?></span></td>
<!--                                        <td class="product-quantity"><input type="number" value="1" /></td>-->
<!--                                        <td class="product-subtotal">£165.00</td>-->
                                        <td class="product-remove"> <a href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Content Start -->
                    <div class="row">
                        <!-- Cart Button Start -->
                        <div class="col-lg-8 col-md-7">
                            <div class="buttons-cart">
                                <a href="<?=Url::toRoute(['/catalog'])?>">Продолжить покупки</a>
                            </div>
                        </div>
                        <!-- Cart Button Start -->
                        <!-- Cart Totals Start -->
                        <div class="col-lg-4 col-md-12">
                            <div class="cart_totals">
                                <h2>Итого в корзине </h2>
                                <br />
                                <table>
                                    <tbody>
<!--                                    <tr class="cart-subtotal">-->
<!--                                        <th>Subtotal</th>-->
<!--                                        <td><span class="amount">$215.00</span></td>-->
<!--                                    </tr>-->
                                    <tr class="order-total">
                                        <th></th>
                                        <td>
                                            <strong><span class="amount"><?= PriceHelper::format($cart->getCost()->getTotal()) ?></span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="wc-proceed-to-checkout">
                                    <a href="<?=Url::toRoute(['/checkout'])?>">Оформить заказ</a>
                                </div>
                            </div>
                        </div>
                        <!-- Cart Totals End -->
                    </div>
                    <!-- Row End -->
                </form>
                <!-- Form End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
</div>
<!-- Cart Main Area End -->


<!-- CONTAIN START -->
<section class="ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="heading-part mb-30">
                    <h2 class="main_title heading "><span><?=Html::encode($this->title)?></span></h2>
                </div>
            </div>
        </div>
        <?php if ($count > 0): ?>
            <div class="row">
                <div class="col-xs-12 mb-xs-30">
                    <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Изображение</th>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Кол-во</th>
                                    <th>Стоимость</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($cart->getItems() as $item): ?>
                                    <?php
                                    $product = $item->getProduct();
                                    $url = Url::to(['/catalog/product', 'id' => $product->id]); ?>
                                    <tr>
                                        <td>
                                            <a href="<?=$url?>">
                                                <div class="product-image">
                                                    <?php if ($product->photo):?>
                                                        <?= Html::img('/'.$product->photo->img_src) ?>
                                                    <?php else: ?>
                                                        <?= Html::img('/images/empty-img.png') ?>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        </td>
                                        <td><div class="product-title"> <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a> </div></td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <div class="base-price price-box"> <span class="price"><?= PriceHelper::format($item->getPrice()) ?> </span> </div>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <?=$item->getQuantity()?>
                                        </td>
                                        <td>
                                            <div class="total-price price-box"> <span class="price"><?= PriceHelper::format($item->getCost()) ?> </span> </div>
                                        </td>
                                        <td><a href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>" ><i title="Удалить товар из корзины" data-id="100" class="fa fa-trash cart-remove-item"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="cart-total-table commun-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Итого</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Общая сумма товаров</td>
                                    <td><div class="price-box"> <span class="price"><?= PriceHelper::format($cart->getCost()->getOrigin()) ?> </span> </div></td>
                                </tr>
                                <tr>
                                    <td ><strong>Ваша скидка</strong></td>
                                    <td ><?= Html::encode($cart->getCost()->getDiscount()->getValue()*100) ?> %</td>
                                </tr>
                                <tr>
                                    <td><b>К оплате</b></td>
                                    <td><div class="price-box"> <span class="price"><b><?= PriceHelper::format($cart->getCost()->getTotal()) ?> </b></span> </div></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <h3 align="center">Ваша корзина пуста</h3>
        <?php endif;?>
        <div class="row">
            <div class="col-sm-6">
                <div> <a href="<?=Url::toRoute(['/catalog'])?>" class="btn btn-color"><span><i class="fa fa-angle-left"></i></span>Продолжить покупки</a> </div>
            </div>
            <?php if ($count > 0): ?>
                <div class="col-sm-6">
                    <div class="right-side float-none-xs"> <a href="<?=Url::toRoute(['/checkout'])?>" class="btn btn-color">Оформить заказ<span><i class="fa fa-angle-right"></i></span></a> </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- CONTAINER END -->
