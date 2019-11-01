<?php

$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];

/*$pageName = 'contact';
$saveAction = \app\modules\admin\controllers\content\PageController::SAVE_ACTION;
$language = Yii::$app->language;*/

use app\models\Config;
use yii\helpers\Html; ?>
<!-- CONTAIN START ptb-70-->
<section class="pt-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="heading-part mb-30">
                    <h2 class="main_title heading "><span><?=Html::encode($this->title)?></span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d168931.07033039996!2d39.21654015413025!3d48.580205822878554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sua!4v1555207622513!5m2!1sen!2sua" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-70 client-main align-center pb-5">
    <div class="container">
        <div class="contact-info">
            <div class="row m-0">
                <div class="col-sm-4 p-0">
                    <div class="contact-box">
                        <div class="contact-icon contact-phone-icon"></div>
                        <span><b>Телефоны</b></span>
                        <p><?=Html::encode(Config::getValue(Config::MAIN_PHONE_1)) ?> / <?=Html::encode(Config::getValue(Config::MAIN_PHONE_2)) ?></p>
                    </div>
                </div>
                <div class="col-sm-4 p-0">
                    <div class="contact-box">
                        <div class="contact-icon contact-mail-icon"></div>
                        <span><b>Эл. почта</b></span>
                        <p><?=Html::encode(Config::getValue(Config::MAIN_EMAIL)) ?></p>
                    </div>
                </div>
                <div class="col-sm-4 p-0">
                    <div class="contact-box">
                        <div class="contact-icon contact-open-icon"></div>
                        <span><b>График</b></span>
                        <p><?=Html::encode(Config::getValue(Config::TIME_WORK)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

