<?php
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];

use app\models\Config;
use yii\bootstrap\Html; ?>
<!-- CONTAIN START ptb-70-->
<section class="ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading-part mb-30">
                            <h2 class="main_title heading "><span><?=Html::encode($this->title)?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= Yii::$app->formatter->asHtml(Config::getValue(Config::PRIVATE_POLICY_TEXT), [
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
</section>

<!-- CONTAINER END -->