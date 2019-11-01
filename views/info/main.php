<?php
$this->title = $title;
//$isGuest = Yii::$app->user->isGuest;

$urlProductPage = \yii\helpers\Url::to('/product');//catalog/view TODO
use app\components\CategoryMenuWidget;
use app\components\ProductSliderWidget;
use app\widgets\CaruselProductsWidget;
use app\widgets\NewsWidget; ?>

<!-- BANNER START -->
<!--<section class="">-->
<!--    <div class="banner">-->
<!--        <div class="main-banner">-->
<!--            <div class="banner-1"> <img src="images/banner1.jpg" alt="Electrro">-->
<!--                <div class="banner-detail">-->
<!--                    <div class="container">-->
<!--                        <div class="row">-->
<!--                            <div class="col-sm-9 col-xs-8">-->
<!--                                <div class="banner-detail-inner">-->
<!--                                    <span class="slogan">Discover</span>-->
<!--                                    <h1 class="banner-title">Buy DJI Osmo Mobile Handheld</h1>-->
<!--                                    <span class="offer">best selling, and popular items.</span>-->
<!--                                </div>-->
<!--                                <a class="btn btn-color" href="shop.html">Shop Now!</a>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3 col-xs-4"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="banner-2"> <img src="images/banner2.jpg" alt="Electrro">-->
<!--                <div class="banner-detail">-->
<!--                    <div class="container">-->
<!--                        <div class="row">-->
<!--                            <div class="col-sm-9 col-xs-8">-->
<!--                                <div class="banner-detail-inner">-->
<!--                                    <span class="slogan">Premium</span>-->
<!--                                    <h1 class="banner-title">New range and popular models </h1>-->
<!--                                    <span class="offer">The latest models for laptop</span>-->
<!--                                </div>-->
<!--                                <a class="btn btn-color" href="shop.html">Shop Now!</a>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3 col-xs-4"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="banner-3"> <img src="images/banner3.jpg" alt="Electrro">-->
<!--                <div class="banner-detail">-->
<!--                    <div class="container">-->
<!--                        <div class="row">-->
<!--                            <div class="col-sm-5 col-xs-4"></div>-->
<!--                            <div class="col-sm-7 col-xs-8">-->
<!--                                <div class="banner-detail-inner">-->
<!--                                    <span class="slogan">UP TO 25% OFF</span>-->
<!--                                    <h1 class="banner-title">Get latest headphone</h1>-->
<!--                                    <span class="offer">Get the top brands for headphone</span>-->
<!--                                </div>-->
<!--                                <a class="btn btn-color" href="shop.html">Shop Now!</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!-- BANNER END -->




<?=CaruselProductsWidget::widget([]) ?>





<?//=NewsWidget::widget()?>

<div class=" pt-70 pb-70">
    <div class="container">
        <div class="ser-feature-block center-sm">
            <div class="row">
<!--                <div class="col-lg-4 service-box border-right">-->
<!--                    <div class="feature-box ">-->
<!--                        <div class="feature-icon feature1"></div>-->
<!--                        <div class="feature-detail">-->
<!--                            <div class="ser-title">Бесплатная доставка</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="col-lg-6 service-box border-right">
                    <div class="feature-box">
                        <div class="feature-icon feature2"></div>
                        <div class="feature-detail">
                            <div class="ser-title">Специальные предложения</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 service-box">
                    <div class="feature-box ">
                        <div class="feature-icon feature3"></div>
                        <div class="feature-detail">
                            <div class="ser-title">Оптимальные цены</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- News Letter Start -->
<!--<section>-->
<!--    <div class="newsletter align-center">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-md-6 col-md-offset-3 ptb-70 client-box">-->
<!--                    <div class="newsletter-inner center-sm">-->
<!--                        <div class="">-->
<!--                            <div class="">-->
<!--                                <div class="newsletter-title">-->
<!--                                    <div class="newsletter-icon">-->
<!--                                        <img alt="Electrro" src="images/newsletter-icon.png">-->
<!--                                    </div>-->
<!--                                    <h2 class="main_title">Подпишитесь на новости</h2>-->
<!--                                    <div class="newsletter-slogan">Получайте последние новости & Обновления</div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="">-->
<!--                                <form>-->
<!--                                    <div class="newsletter-box">-->
<!--                                        <input type="email" placeholder="Эл. почта">-->
<!--                                        <button title="Subscribe" class="btn-color">Подписаться</button>-->
<!--                                    </div>-->
<!--                                </form>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!-- News Letter End -->

