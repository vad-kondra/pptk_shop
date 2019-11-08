<?php

/* @var $this yii\web\View */
/* @var $product Product */


use app\helpers\PriceHelper;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<!-- Single Product Start -->
<div class="col-lg-4 col-sm-6">
    <div class="single-product">
        <!-- Product Image Start -->
        <div class="pro-img">
            <a href="<?= Html::encode(Url::to(['product', 'id' =>$product->id])) ?>">
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
<!--            <div class="product-rating">-->
<!--                <i class="fa fa-star"></i>-->
<!--                <i class="fa fa-star"></i>-->
<!--                <i class="fa fa-star"></i>-->
<!--                <i class="fa fa-star"></i>-->
<!--                <i class="fa fa-star"></i>-->
<!--            </div>-->
            <h4><a href="<?= Html::encode(Url::to(['product', 'id' =>$product->id])) ?>"><?= Html::encode($product->name) ?></a></h4>
            <p>
                <span class="price"><?= PriceHelper::format($product->price_new) ?></span>
                <?php if (isset($product->price_old)): ?>
                    <del class="prev-price"><?= PriceHelper::format($product->price_old) ?></del>
                <?php endif; ?>
            </p>
            <div class="pro-actions">
                <div class="actions-secondary">
<!--                    <a href="wishlist.html" data-toggle="tooltip" title="Добавить в избранное"><i class="fa fa-heart"></i></a>-->
                    <a class="add-cart" href="<?= Url::to(['/cart/add', 'id' => $product->id]) ?>" data-id="<?=$product->id?>" data-toggle="tooltip" title="В корзину">В корзину</a>
<!--                    <a href="compare.html" data-toggle="tooltip" title="Добавить в сравнение"><i class="fa fa-signal"></i></a>-->
                </div>
            </div>
        </div>
        <!-- Product Content End -->
    </div>
</div>
<!-- Single Product End -->


