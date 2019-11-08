<?php

use app\models\Config;
use app\models\user\User;
use app\widgets\CartWidget;
use app\widgets\CategoryMenuWidget;
use app\widgets\CategoryMobileMenuWidget;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<!-- Header Area Start -->
<header>
    <!-- Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Header Top left Start -->
                <div class="col-lg-8 col-md-12 d-center">
                    <div class="header-top-left">
                        <?=Html::img('@web/img/icon/call.png') ?>
                        Связаться с нами:
                        <?=Config::getValue(Config::MAIN_PHONE_1)?>,
                        <?=Config::getValue(Config::MAIN_PHONE_2)?>
                    </div>
                </div>
                <!-- Header Top left End -->
                <!-- Search Box Start -->
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <div class="main-search">
                        <div class="search-box-view">
                            <?=Html::beginForm(['/catalog/search'], 'get') ?>
                            <?=Html::input('text', 'text', $searchForm->text, ['class' => 'email', 'placeholder' => 'Поиск'])?>
                            <button type="submit" class="submit"></button>
                            <?=Html::endForm() ?>
                        </div>
                        <div class="search-fast-result" style="display: block"></div>
                    </div>

                </div>
                <!-- Search Box End -->
                <!-- Header Top Right Start -->
<!--                <div class="col-lg-4 col-md-12">-->
<!--                    <div class="header-top-right">-->
<!--                        <ul class="header-list-menu f-right">-->
                            <!-- Language Start -->
<!--                            <li><a href="#">Language: English <i class="fa fa-angle-down"></i></a>-->
<!--                                <ul class="ht-dropdown">-->
<!--                                    <li><a href="#">Spanish</a></li>-->
<!--                                    <li><a href="#">Bengali</a></li>-->
<!--                                    <li><a href="#">Russian</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
                            <!-- Language End -->
                            <!-- Currency Start -->
<!--                            <li><a href="#">Currency:  USD <i class="fa fa-angle-down"></i></a>-->
<!--                                <ul class="ht-dropdown">-->
<!--                                    <li><a href="#">USD</a></li>-->
<!--                                    <li><a href="#">GBP</a></li>-->
<!--                                    <li><a href="#">EUR</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
                            <!-- Currency End -->
<!--                        </ul>-->
                        <!-- Header-list-menu End -->
<!--                    </div>-->
<!--                </div>-->
                <!-- Header Top Right End -->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Top End -->
    <!-- Header Bottom Start -->
    <div class="header-bottom header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-2 col-sm-5 col-5">
                    <div class="logo">
                        <a href="<?=Url::home()?>"><?=Html::img('@web/images/logo.png', ['alt' => Config::getValue(Config::MAIN_TITLE)]) ?></a>
                    </div>
                </div>
                <!-- Primary Vertical-Menu End -->
                <!-- Search Box Start -->
                <div class="col-xl-6 col-lg-7 d-none d-lg-block">
                    <div class="middle-menu pull-right">
                        <nav>
                            <ul class="middle-menu-list">
                                <li><a href="<?=Url::home()?>">Главная</a></li>

                                <?= CategoryMenuWidget::widget() ?>

<!--                                <li><a href="blog.html">Blog<i class="fa fa-angle-down"></i></a></li>-->
                                <li><a href="<?=Url::to('/about')?>">О нас</a></li>
                                <li><a href="<?=Url::to('/contact')?>">Контакты</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Search Box End -->
                <!-- Cartt Box Start -->
                <div class="col-lg-3 col-sm-7 col-7">
                    <div class="cart-box text-right">
                        <ul>
                            <li><a href="#"><i class="fa fa-cog"></i></a>
                                <ul class="ht-dropdown">
                                    <?php if (Yii::$app->user->isGuest): ?>
                                        <li><a href="<?=Url::to('/sign-in')?>">Вход</a></li>
                                        <li><a href="<?=Url::to('/sign-up')?>">Регистрация</a></li>
                                    <?php else: ?>
                                        <li><a href="<?=Url::to('/profile')?>">Мой профиль</a></li>
                                        <?php if (Yii::$app->user->can(User::ROLE_MANAGER) || Yii::$app->user->can(User::ROLE_ADMIN)) : ?>
                                            <li><a href="<?=Url::to('/admin');?>">Админ-панель</a></li>
                                        <?php endif; ?>
                                        <li><a data-method="post" href="<?=Url::to('/logout')?>">Выход</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
<!--                            <li><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>-->
                            <?=CartWidget::widget() ?>
                        </ul>
                    </div>
                </div>
                <!-- Cartt Box End -->
                <div class="col-sm-12 d-lg-none">
                    <div class="mobile-menu">
                        <nav>
                            <ul>
                                <li><a href="<?=Url::home()?>">Главная</a></li>
                                <?=CategoryMobileMenuWidget::widget() ?>
<!--                                <li><a href="blog.html">Blog</a>-->
<!--                                     Mobile Menu Dropdown Start -->
<!--                                    <ul>-->
<!--                                        <li><a href="blog-details.html">Blog Details Page</a></li>-->
<!--                                    </ul>-->
<!--                                     Mobile Menu Dropdown End -->
<!--                                </li>-->
                                <li><a href="<?=Url::to('/about')?>">О нас</a></li>
                                <li><a href="<?=Url::to('/contact')?>">Контакты</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Mobile Menu  End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Bottom End -->
</header>
<!-- Header Area End -->