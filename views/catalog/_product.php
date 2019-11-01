<?php

/* @var $this yii\web\View */
/* @var $product Product */


use app\helpers\PriceHelper;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['product', 'id' =>$product->id]);
?>

<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2">
    <div class="product-item">
        <div class="product-image">
            <?php if ($product->isNew()): ?>
                <div class="main-label new-label" title="Новинка"><span>Новый</span></div>
            <?php endif;?>
            <?php if ($product->isSale()): ?>
                <div class="main-label sale-label" title="Товар с акцией"><span>Акция</span></div>
            <?php endif;?>

            <a href="<?= Html::encode($url) ?>">
                <?php if($product->photo):?>
                    <?= Yii::$app->thumbnail->img($product->photo->img_src, [
                        'thumbnail' => [
                            'width' => 300,
                            'height' => 300,
                        ],
                        'placeholder' => [
                            'width' => 300,
                            'height' => 300
                        ]
                    ]); ?>
                <?php else: ?>
                    <?= Html::img('/images/empty-img.png') ?>
                <?php endif; ?>
            </a>
            <div class="product-detail-inner">
                <div class="detail-inner-left left-side">
                    <ul>
                        <li class="pro-cart-icon">
                            <button class="addToCartButton" href="<?= Url::to(['/cart/add', 'id' => $product->id]) ?>" data-id="<?=$product->id?>"><span></span>В корзину</button>
                        </li>
                    </ul>
                </div>
                <div class="detail-inner-left right-side">
                    <ul>
<!--                        <li class="pro-wishlist-icon active"><a href="#" title="В избранное"></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-item-details">
            <div class="product-item-name"> <a href="<?= Html::encode($url) ?>"><?= Html::encode($product->name) ?></a></div>
            <div class="price-box">
                <span class="price"><?= PriceHelper::format($product->price_new) ?></span>
                <?php if (isset($product->price_old)): ?>
                <del class="price old-price"><?= PriceHelper::format($product->price_old) ?></del>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

