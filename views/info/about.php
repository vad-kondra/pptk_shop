<?php
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];

use app\models\Config;
use yii\bootstrap\Html; ?>


<!-- About Main Area Start -->
<div class="about-main-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <div class="about-img">
                    <img alt="Electrro" src="images/logo2.png">
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="about-content">
                    <h3><?=Html::encode(Config::getValue(Config::MAIN_TITLE))?></h3>
                    <?= Yii::$app->formatter->asHtml(Config::getValue(Config::ABOUT_TEXT), [
                        'Attr.AllowedRel' => array('nofollow'),
                        'HTML.SafeObject' => true,
                        'Output.FlashCompat' => true,
                        'HTML.SafeIframe' => true,
                        'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Main Area End -->
