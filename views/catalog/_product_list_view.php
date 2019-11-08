<?php

/* @var $this yii\web\View */
/* @var $product Product */


use app\helpers\PriceHelper;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<!-- Single Product Start -->
<div class="single-product">
    <!-- Product Image Start -->
    <div class="pro-img">
        <a href="<?= Html::encode(Url::to(['product', 'id' =>$product->id])) ?>">

            <?php if($product->photo):?>
                <?=Yii::$app->thumbnail->img($product->photo->img_src, [
                    'placeholder' => [
                        'width' => 350,
                        'height' => 350
                    ]
                ]); ?>
            <?php else: ?>
                <?=Yii::$app->thumbnail->img(null, [
                    'placeholder' => [
                        'width' => 350,
                        'height' => 350
                    ]
                ]); ?>
            <?php endif; ?>

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
        <h4><a href="<?= Html::encode(Url::to(['product', 'id' =>$product->id])) ?>"><?= Html::encode($product->name) ?></a></h4>
        <p>
            <span class="price"><?= PriceHelper::format($product->price_new) ?></span>
            <?php if (isset($product->price_old)): ?>
                <del class="prev-price"><?= PriceHelper::format($product->price_old) ?></del>
            <?php endif; ?>
        </p>
        <p><?= Html::encode($product->description) ?></p>
        <div class="pro-actions">
            <div class="actions-secondary">
<!--                <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>-->
                <a class="add-cart" href="<?= Url::to(['/cart/add', 'id' => $product->id]) ?>" data-id="<?=$product->id?>" data-toggle="tooltip" title="В корзину">В корзину</a>
<!--                <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>-->
            </div>
        </div>
    </div>
    <!-- Product Content End -->
</div>
<!-- Single Product Start -->

