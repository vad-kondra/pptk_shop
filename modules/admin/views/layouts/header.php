<?php

use app\models\user\User;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">E</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <?php if(Yii::$app->user->can(User::ROLE_ADMIN)){?>
                    <li>
                        <a title="Очистить кеш" href="<?=Url::to('/admin/default/clear-cache')?>"><i class="fa fa-wrench"></i></a>
                    </li>
                <?php } ?>
                <li>
                    <a title="Выйти" href="<?=Url::to('/admin/default/logout')?>"><i class="fa fa-sign-out"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
