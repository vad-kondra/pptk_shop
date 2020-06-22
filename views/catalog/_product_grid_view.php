<?php

/* @var $this yii\web\View */
/* @var $product Product */

use app\helpers\PriceHelper;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-lg-4 col-sm-6">
    <div class="single-product">
        <div class="pro-img">
            <a href="<?= Html::encode(Url::to(['product', 'id' =>$product->id])) ?>">

                <?php
                $img_src = null;
                if(isset($product->photo)) {
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
        <div class="pro-content">
            <h4> <a href="<?= Html::encode(Url::to(['product', 'id' =>$product->id])) ?>"><?= Html::encode($product->name) ?></a></h4>
            <p>
                <span class="price"><?= PriceHelper::format($product->price_new) ?></span>
                <?php if (isset($product->price_old)): ?>
                    <del class="prev-price"><?=PriceHelper::format($product->price_old) ?></del>
                <?php endif; ?>
            </p>
            <div class="pro-actions">
                <div class="actions-secondary">
                    <a class="add-cart" href="<?= Url::to(['/cart/add', 'id' => $product->id]) ?>" data-id="<?=$product->id?>" data-toggle="tooltip" title="В корзину">В корзину</a>
                </div>
            </div>
        </div>
    </div>
</div>


