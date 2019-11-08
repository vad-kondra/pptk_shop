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
        <h2 class="text-capitalize sub-heading"><?=Html::encode($this->title)?></h2>
        <div class="row">
            <div class="col-md-12">
                <?php if ($count > 0): ?>
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
                                                <?php $img_src = null;
                                                if($product->photo) {
                                                    $img_src = $product->photo->img_src;
                                                }?>
                                                <?=Yii::$app->thumbnail->img($img_src, [
                                                    'placeholder' => [
                                                        'width' => 350,
                                                        'height' => 350
                                                    ],
                                                    'thumbnail' => [
                                                        'width' => 350,
                                                        'height' => 350,
                                                    ]
                                                ]); ?>
                                            </a>
                                        </td>
                                        <td class="product-name"><a href="<?=$url?>"><?= Html::encode($product->name) ?></a></td>
                                        <td class="product-price"><span class="amount"><?= PriceHelper::format($item->getPrice()) ?></span></td>
    <!--                                        <td class="product-quantity"><input type="number" value="1" /></td>-->
    <!--                                        <td class="product-subtotal">£165.00</td>-->
                                        <td class="product-remove"> <a class="product-remove" data-id="<?=$item->getId()?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Content Start -->
                <?php else: ?>
                    <h3 align="center">Ваша корзина пуста</h3>
                <?php endif;?>
                <div class="row">
                    <!-- Cart Button Start -->
                    <div class="col-lg-8 col-md-7">
                        <div class="buttons-cart">
                            <a href="<?=Url::toRoute(['/catalog'])?>">Продолжить покупки</a>
                        </div>
                    </div>
                    <!-- Cart Button Start -->
                    <?php if ($count > 0): ?>
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
                    <?php else: ?>

                    <?php endif;?>
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
</div>
<!-- Cart Main Area End -->
