<?php

use app\models\Config;
use yii\helpers\Html;


?>
<!-- HEADER START -->
<header class="navbar navbar-custom container-full-sm" id="header">

    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-4">
                    <div class="middle-link">
                        <ul>
                            <!--<li class="login-icon content">
                                <a class="content-link">
                                    <span class="content-icon"></span>
                                </a>
                                <div class="content-dropdown">
                                    <ul>
                                        <li class="login-icon"><a href="<?/*=$urlSignIn*/?>" title="Войти"><i class="fa fa-sign-in"></i> Войти</a></li>
                                        <li class="register-icon"><a href="<?/*=$urlSignUp*/?>" title="Регистрация"><i class="fa fa-user-plus"></i> Регистрация</a></li>
                                        <li class="register-icon"><a href="<?/*=$urlProfile*/?>" title="Профиль"><i class="fa fa-user"></i> Профиль</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="gift-icon">
                                <a href="<?/*$urlTermsPayment*/?>" title="Условия оплаты"><span></span> Условия оплаты</a>
                            </li>
                            <li class="track-icon">
                                <a href="<?/*$urlTermsDelivery*/?>" title="Условия доставки"><span></span> Условия доставки</a>
                            </li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-xs-8">
                    <div class="top-link text-right right-xs">
                        <div class="help-num">
                            <?php
                            $phones = [
                                Config::getValue(Config::MAIN_PHONE_1),
                                Config::getValue(Config::MAIN_PHONE_2),
                            ]; ?>
                            <?php foreach ($phones as $phone): ?>
                                <span class="mr-4"><i class="fa fa-phone"></i><?=Html::encode($phone) ?></span>
                            <?php endforeach; ?>

                            <span class="mr-4"><a id="call_back_btn"><i class="fa fa-phone-square text-primary"></i> Заказать обратный звонок</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->render('header_middle.php') ?>
    <?= $this->render('header_bottom.php') ?>

</header>
<!-- HEADER END -->