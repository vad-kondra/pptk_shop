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
        <div class="single-cart-box">
            <div class="cart-img">
                <a href="#">
                    <?php
                    $img_src = null;
                    if(isset($product->photo) && file_exists($product->photo->img_src)) {
                        $img_src = $product->photo->img_src;
                    }
                    echo Yii::$app->thumbnail->img($img_src, [
                        'placeholder' => [
                            'width' => 400,
                            'height' => 400
                        ],
                        'thumbnail' => [
                            'width' => 400,
                            'height' => 400,
                        ]
                    ]);
                    ?>
                </a>
            </div>
            <div class="cart-content">
                <h6><a href="<?=$url?>"><?= Html::encode($product->name ) ?></a></h6>
                <span><?= PriceHelper::format($item->getPrice()) ?></span>
            </div>
        </div>
    <?php endforeach; ?>
</li>
<div class="cart-footer fix">
    <h5>Всего :<span class="f-right"><?= PriceHelper::format($cart->getCost()->getOrigin()) ?></span></h5>
    <div class="cart-actions">
        <a class="checkout" href="<?=Url::to('/checkout')?>">Оформить заказ</a>
    </div>
</div>
<?php else:?>
    <div>Ваша корзина пуста</div>
<?php endif;?>

