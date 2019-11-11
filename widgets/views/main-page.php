<?php

use app\helpers\PriceHelper;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $queryNew Product[] */
/* @var $querySale Product[] */
/* @var $queryBest Product[] */
/* @var $headers string[] */

?>


<!-- New Products Start -->
<div class="new-products pb-60 pt-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 order-2">
                <div class="side-product-list">
                    <div class="group-title">
                        <h2><?=$headers[0]?></h2>
                    </div>
                    <!-- Deal Pro Activation Start -->
                    <div class="slider-right-content side-product-list-active owl-carousel">
                        <!-- Double Product Start -->
                        <div class="double-pro">

                            <?php foreach ($queryBest as $product) : ?>
                                <?= $this->render('_product', [
                                    'product' => $product
                                ]) ?>
                            <?php endforeach; ?>

                        </div>
                        <!-- Double Product End -->
                        <!-- Double Product Start -->
<!--                        <div class="double-pro">-->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/6.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/7.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/8.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/5.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/4.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                        </div>-->
                        <!-- Double Product End -->
                        <!-- Double Product Start -->
<!--                        <div class="double-pro">-->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/1.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/2.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/3.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/4.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                             Single Product Start -->
<!--                            <div class="single-product">-->
<!--                                <div class="pro-img">-->
<!--                                    <a href="product.html"><img class="img" src="img/products/5.jpg" alt="product-image"></a>-->
<!--                                </div>-->
<!--                                <div class="pro-content">-->
<!--                                    <div class="product-rating">-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                        <i class="fa fa-star"></i>-->
<!--                                    </div>-->
<!--                                    <h4><a href="product.html">Products Name Here</a></h4>-->
<!--                                    <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                             Single Product End -->
<!--                        </div>-->
                        <!-- Double Product End -->
                    </div>
                    <!-- Deal Pro Activation End -->
                </div>
            </div>
            <div class="col-xl-9 col-lg-8  order-lg-2">
                <!-- New Pro Content End -->
                <div class="new-pro-content">
                    <div class="pro-tab-title border-line">
                        <!-- Featured Product List Item Start -->
                        <ul class="nav product-list product-tab-list">
                            <li><a  class="active" data-toggle="tab" href="#new-arrival"><?=$headers[1]?></a></li>
                            <li><a data-toggle="tab" href="#toprated"><?=$headers[2]?></a></li>
                            <!--                            <li><a data-toggle="tab" href="#new-arrival">Top Rated</a></li>-->
                        </ul>
                        <!-- Featured Product List Item End -->
                    </div>
                    <div class="tab-content product-tab-content jump">
                        <div id="new-arrival" class="tab-pane active">
                            <!-- New Products Activation Start -->
                            <div class="new-pro-active owl-carousel">

                                <?php foreach ($queryNew as $product) : ?>
                                    <?= $this->render('_product', [
                                        'product' => $product
                                    ]) ?>
                                <?php endforeach; ?>
                            </div>
                            <!-- New Products Activation End -->
                        </div>
                        <!-- New Products End -->
                        <div id="toprated" class="tab-pane">
                            <!-- New Products Activation Start -->
                            <div class="new-pro-active owl-carousel">

                                <?php foreach ($querySale as $product) : ?>
                                    <?= $this->render('_product', [
                                        'product' => $product
                                    ]) ?>
                                <?php endforeach; ?>
                            </div>
                            <!-- New Products Activation End -->
                        </div>
                    </div>
                    <!-- Tab-Content End -->
                    <!--                    <div class="single-banner zoom mt-30 mt-sm-10">-->
                    <!--                        <a href="#"><img src="img/banner/tab-banner.jpg" alt="slider-banner"></a>-->
                    <!--                    </div>-->
                </div>
                <!-- New Pro Content End -->
            </div>
        </div>

    </div>
    <!-- Container End -->
</div>
<!-- New Products End -->
