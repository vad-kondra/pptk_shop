<?php

use app\models\Config;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<footer class="off-white-bg">
    <!-- Footer Top Start -->
    <div class="footer-top pt-50 pb-60">
        <div class="container">
<!--            <div class="row">-->
<!--                <div class="col-lg-6 mr-auto ml-auto">-->
<!--                    <div class="newsletter text-center">-->
<!--                        <div class="main-news-desc">-->
<!--                            <div class="news-desc">-->
<!--                                <h3>Sign Up For Newsletters</h3>-->
<!--                                <p>Get e-mail updates about our latest shop and special offers.</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="newsletter-box">-->
<!--                            <form action="#">-->
<!--                                <input class="subscribe" placeholder="Enter your email address" name="email" id="subscribe" type="text">-->
<!--                                <button type="submit" class="submit">subscribe</button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="row">
                <!-- Single Footer Start -->
                <div class="col-lg-4  col-md-7 col-sm-6">
                    <div class="single-footer">
                        <h3>Связаться с нами</h3>
                        <div class="footer-content">
                            <div class="loc-address">
                                <span><i class="fa fa-map-marker"></i><?=Html::encode(Config::getValue(Config::MAIN_ADDRESS)) ?></span>
                                <span><i class="fa fa-envelope-o"></i><?=Html::mailto(Config::getValue(Config::MAIN_EMAIL)) ?></span>
                                <span><i class="fa fa-phone"></i><?=Html::encode(Config::getValue(Config::MAIN_PHONE_1)) ?></span>
                                <span><i class="fa fa-phone"></i><?=Html::encode(Config::getValue(Config::MAIN_PHONE_2)) ?></span>
                            </div>
                            <div class="payment-mth">
<!--                                <a href="#"><img class="img" src="img/footer/1.png" alt="payment-image"></a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-2  col-md-5 col-sm-6 footer-full">
                    <div class="single-footer">
                        <h3 class="footer-title">Информация</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
<!--                                <li><a href="#">Site Map</a></li>-->
<!--                                <li><a href="#">Specials</a></li>-->
<!--                                <li><a href="#">Jobs</a></li>-->
<!--                                <li><a href="#">Delivery Information</a></li>-->
                                <li><a href="<?=Url::to('/profile')?>">История заказов</a></li>
                                <li><a href="<?=Url::to('/terms')?>">Политика конфиденциальности</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-2  col-md-4 col-md-4 col-sm-6 footer-full">
                    <div class="single-footer">
                        <h3 class="footer-title">Мой профиль</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="<?=Url::to('/profile')?>">Профиль</a></li>
                                <li><a href="<?=Url::to('/checkout')?>">Оформление</a></li>
                                <li><a href="<?=Url::to('/sign-in')?>">Вход</a></li>
<!--                                <li><a href="#">address</a></li>-->
<!--                                <li><a href="#">Order status</a></li>-->
<!--                                <li><a href="#">Site Map</a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
<!--                <div class="col-lg-2 col-md-4 col-sm-6 footer-full">-->
<!--                    <div class="single-footer">-->
<!--                        <h3 class="footer-title">customer service</h3>-->
<!--                        <div class="footer-content">-->
<!--                            <ul class="footer-list">-->
<!--                                <li><a href="account.html">My account</a></li>-->
<!--                                <li><a href="#">New</a></li>-->
<!--                                <li><a href="#">Gift Cards</a></li>-->
<!--                                <li><a href="#">Return Policy</a></li>-->
<!--                                <li><a href="#">Your Orders</a></li>-->
<!--                                <li><a href="#">Subway</a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
<!--                <div class="col-lg-2 col-md-4 col-sm-6 footer-full">-->
<!--                    <div class="single-footer">-->
<!--                        <h3 class="footer-title">Let Us Help You</h3>-->
<!--                        <div class="footer-content">-->
<!--                            <ul class="footer-list">-->
<!--                                <li><a href="#">Your Account</a></li>-->
<!--                                <li><a href="#">Your Orders</a></li>-->
<!--                                <li><a href="#">Shipping</a></li>-->
<!--                                <li><a href="#">Amazon Prime</a></li>-->
<!--                                <li><a href="#">Replacements</a></li>-->
<!--                                <li><a href="#">Manage </a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- Single Footer Start -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Top End -->
    <!-- Footer Bottom Start -->
    <div class="footer-bottom off-white-bg2">
        <div class="container">
            <div class="footer-bottom-content">
                <p class="copy-right-text">2019 © <a  href="http://www.pptk-lnr.ru">ППТК</a> Все права зищищены.</p>
<!--                <div class="footer-social-content">-->
<!--                    <ul class="social-content-list">-->
<!--                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
<!--                        <li><a href="#"><i class="fa fa-wifi"></i></a></li>-->
<!--                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>-->
<!--                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>-->
<!--                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Bottom End -->
</footer>
<!-- Footer End -->