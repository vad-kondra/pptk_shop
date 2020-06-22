<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $main_title string */
/* @var $contacts_text string */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>

<!--<div class="container">-->
<!--    <div class="map">-->
<!--        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d168931.07033039996!2d39.21654015413025!3d48.580205822878554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sua!4v1555207622513!5m2!1sen!2sua" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
<!--    </div>-->
<!--</div>-->

<div class="align-center pb-5">
    <div class="container">
        <div class="contact-info">
            <div class="row">
                <div class="col">
                    <h3><?=Html::encode($main_title)?></h3>
                    <?= Yii::$app->formatter->asHtml($contacts_text, [
                        'Attr.AllowedRel' => array('nofollow'),
                        'HTML.SafeObject' => true,
                        'Output.FlashCompat' => true,
                        'HTML.SafeIframe' => true,
                        'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                    ]) ?>
                </div>
            </div>
<!--            <div class="row m-0">-->
<!--                <div class="col-sm-4 p-0">-->
<!--                    <div class="contact-box">-->
<!--                        <div class="contact-icon contact-phone-icon"></div>-->
<!--                        <span><b>Телефоны</b></span>-->
<!--                        <p>--><?//=Html::encode(Config::getValue(Config::MAIN_PHONE_1)) ?><!-- / --><?//=Html::encode(Config::getValue(Config::MAIN_PHONE_2)) ?><!--</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-sm-4 p-0">-->
<!--                    <div class="contact-box">-->
<!--                        <div class="contact-icon contact-mail-icon"></div>-->
<!--                        <span><b>Эл. почта</b></span>-->
<!--                        <p>--><?//=Html::encode(Config::getValue(Config::MAIN_EMAIL)) ?><!--</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-sm-4 p-0">-->
<!--                    <div class="contact-box">-->
<!--                        <div class="contact-icon contact-open-icon"></div>-->
<!--                        <span><b>График</b></span>-->
<!--                        <p>--><?//=Html::encode(Config::getValue(Config::TIME_WORK)) ?><!--</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</div>






