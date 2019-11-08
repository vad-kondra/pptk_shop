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
<?php if ($count > 0): ?>
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
                </div>
                <div class="cart-content">
                    <h6><a href="<?=$url?>"><?= Html::encode($product->name ) ?></a></h6>
                    <span><?= PriceHelper::format($item->getPrice()) ?></span>
                </div>
<!--                <a class="del-icone" data-id="--><?//=$item->getId()?><!--"><i class="fa fa-times"></i></a>-->
            </div>
            <!-- Cart Box End -->
        <?php endforeach; ?>
</li>
<!-- Cart Footer Inner Start -->
<div class="cart-footer fix">
    <h5>Всего :<span class="f-right"><?= PriceHelper::format($cart->getCost()->getOrigin()) ?></span></h5>
    <div class="cart-actions">
        <a class="checkout" href="<?=Url::to('/checkout')?>">Оформить заказ</a>
    </div>
</div>
<!-- Cart Footer Inner End -->
<?php else:?>
    <div>Ваша корзина пуста</div>
<?php endif;?>

