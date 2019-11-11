<?php

use app\helpers\PriceHelper;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $product Product */

?>


<!-- Single Product Start -->
<div class="single-product">
    <!-- Product Image Start -->
    <div class="pro-img">
        <a href="<?= Html::encode(Url::to(['/catalog/product', 'id' =>$product->id])) ?>">
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
    <!-- Product Image End -->
    <!-- Product Content Start -->
    <div class="pro-content">
<!--        <div class="product-rating">-->
<!--            <i class="fa fa-star"></i>-->
<!--            <i class="fa fa-star"></i>-->
<!--            <i class="fa fa-star"></i>-->
<!--            <i class="fa fa-star"></i>-->
<!--            <i class="fa fa-star"></i>-->
<!--        </div>-->
        <h4><a href="<?= Html::encode(Url::to(['/catalog/product', 'id' =>$product->id])) ?>"><?= Html::encode($product->name) ?></a></h4>
        <p>
            <span class="price"><?= PriceHelper::format($product->price_new) ?></span>
            <?php if (isset($product->price_old)): ?>
                <del class="prev-price"><?= PriceHelper::format($product->price_old) ?></del>
            <?php endif; ?>
        </p>
<!--        <div class="pro-actions">-->
<!--            <div class="actions-secondary">-->
<!--                <a class="add-cart" href="--><?//= Url::to(['/cart/add', 'id' => $product->id]) ?><!--" data-id="--><?//=$product->id?><!--" data-toggle="tooltip" title="В корзину">В корзину</a>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <!-- Product Content End -->
</div>
<!-- Single Product End -->


