<?php

use app\models\Config;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<!-- FOOTER START -->
<div class="footer">
    <div class="container">
        <div class="footer-inner">
            <div class="footer-middle">
                <div class="row mb-60">
                    <div class="col-md-3 f-col footer-middle-left">
                        <div class="footer-static-block"> <span class="opener plus"></span>
                            <h3 class="title">Адрес<span></span></h3>
                            <ul class="footer-block-contant address-footer">
                                <li class="item"> <i class="fa fa-map-marker"> </i>
                                    <p><?=Html::encode(Config::getValue(Config::MAIN_ADDRESS)) ?></p>
                                </li>
                                <li class="item"> <i class="fa fa-envelope"> </i>
                                    <p> <?=Html::mailto(Config::getValue(Config::MAIN_EMAIL)) ?> </p>
                                </li>
                                <li class="item"> <i class="fa fa-phone"> </i>
                                    <p><?=Html::encode(Config::getValue(Config::MAIN_PHONE_1)) ?></p>
                                </li>
                                <li class="item"> <i class="fa fa-phone"> </i>
                                    <p><?=Html::encode(Config::getValue(Config::MAIN_PHONE_2)) ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 footer-middle-right">
                        <div class="row">
                            <div class="col-md-4 f-col col-lg-offset-2">
<!--                                <div class="footer-static-block"> <span class="opener plus"></span>-->
<!--                                    <h3 class="title">помощь <span></span></h3>-->
<!--                                    <ul class="footer-block-contant link">-->
<!--                                        <li><a href="--><?//=$urlTermsPayment?><!--"> Условия оплаты</a></li>-->
<!--                                        <li><a href="--><?//=$urlTermsDelivery?><!--"> Условия доставки</a></li>-->
<!--                                        <li><a href="">Статус заказа</a></li>-->
<!--                                        <li><a href="">Возврат & Обмен</a></li>-->
<!--                                    </ul>-->
<!--                                </div>-->
                            </div>
                            <div class="col-md-4 f-col col-lg-offset-2">
                                <div class="footer-static-block"> <span class="opener plus"></span>
                                    <h3 class="title">Информация <span></span></h3>
                                    <ul class="footer-block-contant link">
                                        <li><a href="<?=Url::to('/contact');?>">Контакты</a></li>
                                        <li><a href="<?=Url::to('/about')?>">О нас</a></li>
                                        <li><a href="<?=Url::to('/terms')?>">Пользовательское соглашение</a></li>
<!--                                        <li><a href="">Faq</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="scroll-top">
    <div id="scrollup"></div>
</div>
<!-- FOOTER END -->
