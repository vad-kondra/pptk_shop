<?php

use app\helpers\PriceHelper;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $queryNew Product[] */
/* @var $querySale Product[] */
/* @var $headers string[] */



?>

<!--  Featured Products Slider Block Start  -->

<div class="featured-product pt-70">
    <div class="container">
        <div class="product-listing">
            <div class="row">
                <div class="col-xs-12">
                    <div class="heading-part mb-30 mb-xs-15">
                        <div id="tabs" class="category-bar">
                            <ul class="tab-stap">
                                <li><a class="tab-step1 selected" title="step1"><?=$headers[0]?></a></li>
                                <li><a class="tab-step2" title="step2"><?=$headers[1]?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="items">
                    <div class="tab_content pro_cat">
                        <ul>
                            <li>
                                <div id="data-step1" class="items-step1 product-slider-main position-r selected" data-temp="tabdata">
                                    <div class="row">
                                        <div class="tab_cat">
                                            <div class="owl-carousel tab_slider">
                                                <?php foreach ($queryNew as $product) : ?>
                                                    <div class="item">
                                                        <?php $url = Url::to(['/catalog/product', 'id' =>$product->id]); ?>
                                                        <div class="product-item">
                                                            <div class="main-label new-label"><span>Новый</span></div>
                                                            <?php if ($product->isSale()): ?>
                                                                <div class="main-label sale-label"><span>Aкция</span></div>
                                                            <?php endif;?>
                                                            <div class="product-image">
                                                                <a href="<?= Html::encode($url) ?>">
                                                                    <?php if(isset($product->photo)):?>
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
                                                                                <button class="addToCartButton"  data-id="<?=$product->id?>"><span></span>В корзину</button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="detail-inner-left right-side">
                                                                        <ul>
                                                                            <!--                                                                                    <li class="pro-wishlist-icon"><a href="wishlist.html" title="Wishlist"></a></li>-->
                                                                            <!--                                                                                    <li class="pro-compare-icon"><a href="compare.html" title="Compare"></a></li>-->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-item-details">
                                                                <div class="product-item-name"> <a href="<?= Html::encode($url) ?>"><?= Html::encode($product->name) ?></a> </div>
                                                                <div class="price-box">
                                                                    <span class="price"><?= PriceHelper::format($product->price_new) ?></span>
                                                                    <?php if (isset($product->price_old)): ?>
                                                                        <del class="price old-price"><?= PriceHelper::format($product->price_old) ?></del>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div id="data-step2" class="items-step2 product-slider-main position-r" data-temp="tabdata">
                                    <div class="row">
                                        <div class="tab_cat">
                                            <div class="owl-carousel tab_slider">
                                                <?php foreach ($querySale as $product) : ?>
                                                    <div class="item">
                                                        <?php $url = Url::to(['/catalog/product', 'id' =>$product->id]); ?>
                                                        <div class="product-item"> <!--  if sold add class 'sold-out'-->
                                                            <?php if ($product->isNew()): ?>
                                                                <div class="main-label new-label"><span>Новый</span></div>
                                                                <!--                                                        <div class="main-label sale-label"><span>Aкция</span></div>-->
                                                            <?php endif;?>

                                                            <?php if ($product->isSale()): ?>
                                                                <div class="main-label sale-label"><span>Aкция</span></div>
                                                            <?php endif;?>
                                                            <div class="product-image">
                                                                <a href="<?= Html::encode($url) ?>">
                                                                    <?php if($product->photo):?>
                                                                        <?= Html::img('/'.$product->photo->img_src) ?>
                                                                    <?php else: ?>
                                                                        <?= Html::img('/images/empty-img.png') ?>
                                                                    <?php endif; ?>
                                                                </a>
                                                                <div class="product-detail-inner">
                                                                    <div class="detail-inner-left left-side">
                                                                        <ul>
                                                                            <li class="pro-cart-icon">
                                                                                <button class="addToCartButton"  data-id="<?=$product->id?>"><span></span>В корзину</button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="detail-inner-left right-side">
                                                                        <ul>
                                                                            <!--                                                                                    <li class="pro-wishlist-icon"><a href="wishlist.html" title="Wishlist"></a></li>-->
                                                                            <!--                                                                                    <li class="pro-compare-icon"><a href="compare.html" title="Compare"></a></li>-->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-item-details">
                                                                <div class="product-item-name"> <a href="<?= Html::encode($url) ?>"><?= Html::encode($product->name) ?></a> </div>
                                                                <div class="price-box">
                                                                    <span class="price"><?= PriceHelper::format($product->price_new) ?></span>
                                                                    <?php if (isset($product->price_old)): ?>
                                                                        <del class="price old-price"><?= PriceHelper::format($product->price_old) ?></del>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Featured Products Slider Block End  -->