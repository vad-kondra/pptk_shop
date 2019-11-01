<?php


use app\widgets\CategoryMenuWidget;
use yii\helpers\Url;




$urlTermsDelivery = Url::to('/delivery');//info/delivery

 ?>

<div class="header-bottom">     <!-- !!!!!!!!!  МЕНЮ КАТАЛОГА   header-bottom   !!!!!!!!!  -->
    <div class="container">
        <div class="row position-r">

            <?= CategoryMenuWidget::widget() ?>


            <div class="col-lg-10 col-md-9 col-lgmd-80per">
                <div class="bottom-inner">
                    <div class="position-r">
                        <div class="nav_sec position-r">
                            <div class="mobilemenu-title mobilemenu">
                                <span>Меню</span>
                                <i class="fa fa-bars pull-right"></i>
                            </div>
                            <div class="mobilemenu-content">
                                <ul class="nav navbar-nav" id="menu-main">
                                    <li class="active">
                                        <a href="<?=Url::home()?>">Главная</a>
                                    </li>
                                    <li class="active">
                                        <a href="<?=Url::to('/catalog')?>">Каталог товаров</a>
                                    </li>
<!--                                    <li class="active">-->
<!--                                        <a href="--><?//=Url::to('/stock')?><!--">Акции</a>-->
<!--                                    </li>-->
                                    <li class="active">
                                        <a href="<?=Url::to('/contact')?>">Контакты</a>
                                    </li>
                                    <li class="active">
                                        <a href="<?=Url::to('/about')?>">О нас</a>
                                    </li>
<!--                                    <li class="active">-->
<!--                                        <a href="--><?//=Url::to('/producers')?><!--">Производители/Бренд</a>-->
<!--                                    </li>-->

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
