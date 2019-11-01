<?php

use app\helpers\PriceHelper;
use app\models\Config;
use app\models\search\SearchForm;
use app\models\user\User;
use app\widgets\CartWidget;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;



$urlWishList = Url::to('/wish-list');//user/wish-list



$isGuest = Yii::$app->user->isGuest;
if(!$isGuest) {
    $currentUser = Yii::$app->user->identity;
    $username = $currentUser->username;
}
$session = Yii::$app->session;

$searchForm = new SearchForm();
?>


<div class="header-middle">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-lgmd-20per">
                <div class="header-middle-left">
                    <div class="navbar-header float-none-sm">
                        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><i class="fa fa-bars"></i></button>
                        <a class="navbar-brand page-scroll" href="<?=Url::home()?>">
                            <?=Html::img('@web/images/logo.png', ['alt' => Config::getValue(Config::MAIN_TITLE)]) ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-lgmd-60per mt-20">
                <div class="header-right-part">
                    <?= Html::beginForm(['/catalog/search'], 'get') ?>
                        <div class="category-dropdown">
                            <?= Html::activeDropDownList($searchForm, 'category', $searchForm->categoriesListForSearchForm(), ['prompt' => 'Все категории']) ?>
                        </div>
                        <div class="main-search">
                            <div class="header_search_toggle desktop-view">
                                <div class="search-box">
                                    <?=Html::input('text', 'text', $searchForm->text, ['class' => 'input-text', 'placeholder' => 'найти...'])?>
                                    <button class="search-btn"></button>
                                </div>
                            </div>
                            <div class="search-fast-result" style="display: block"></div>
                        </div>
                    <?= \yii\helpers\Html::endForm() ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-lgmd-20per mt-20">
                <div class="right-side float-left-xs header-right-link">
                    <ul>
                        <li class="login-icon content">
                            <a class="content-link">
                                <span>
                                    <i class="fa fa-user"></i>
                                </span>
                            </a>
                            <div class="content-dropdown">
                                <ul>
                                    <?php if (Yii::$app->user->isGuest): ?>
                                        <li class="login-icon"><a href="<?=Url::to('/sign-in')?>" title="Войти"><i class="fa fa-sign-in"></i> Войти</a></li>
                                        <li class="register-icon"><a href="<?=Url::to('/sign-up')?>" title="Регистрация"><i class="fa fa-user-plus"></i> Регистрация</a></li>
                                    <?php else: ?>
                                        <li class="profile-user-img"><i class="fa fa-user"></i> <?=$username?></li>
                                        <?php if (Yii::$app->user->can(User::ROLE_MANAGER) || Yii::$app->user->can(User::ROLE_ADMIN)) : ?>
                                            <li class="profile-user-img"><a href="<?=Url::to('/admin');?>" title="Админ-панель"><i class="fa fa-key"></i> Админ-панель</a></li>
                                        <?php endif; ?>
                                        <li class="profile-user-img"><a href="<?=Url::to('/profile')?>" title="Профиль"><i class="fa fa-user"></i> Профиль</a></li>
                                        <li class=""><a data-method="post" href="<?=Url::to('/logout')?>" title="Выйти"><i class="fa fa-sign-out"></i> Выйти</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                        <li class="cart-icon">
                            <a class="showCartIcon">
                                <span><i class="fa fa-shopping-cart"></i>
                                    <small id="itemCount" class="cart-notification fz-12"></small>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>