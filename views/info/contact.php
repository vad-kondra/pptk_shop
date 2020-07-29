<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $main_title string */
/* @var $contacts_text string */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>

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
            <div class="row pt-40">
                <div style="width: 100%">
                    <iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&amp;height=300&amp;hl=ru&amp;coord=48.548014, 39.331321&amp;q=%D0%B3.%20%D0%9B%D1%83%D0%B3%D0%B0%D0%BD%D1%81%D0%BA%2C%20%D1%83%D0%BB.%20%D0%9E%D0%B1%D0%BE%D1%80%D0%BE%D0%BD%D0%BD%D0%B0%D1%8F%2C%2024+(%D0%9E%D0%9E%D0%9E%20%C2%AB%D0%9F%D0%9F%D0%A2%D0%9A%C2%BB)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="http://www.gps.ie/">GPS coordinates</a></iframe>
                </div>
                <br/>
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






