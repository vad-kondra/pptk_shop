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
                <div class="about-detail">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="heading-part mb-30">
                                <h2 class="main_title heading "><span><?=Html::encode($this->title)?></span></h2>
                            </div>
                        </div>
                        <div class="col-xl-5 col-sm-5 col-md-5  mb-xl-6">
                            <div class="image-part center-xs"> <img alt="Electrro" src="images/logo2.png"> </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="heading-part align_left center-md">
                                <h2 class="heading"><?=Html::encode(Config::getValue(Config::MAIN_TITLE))?></h2>
                            </div>
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
<!--                <div class="row mt-40">-->
<!--                    <div class="col-xs-12">-->
<!--                        <h3>Наши преимущества</h3>-->
<!--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. etiam nec suscipit arcu, feugiat fermentum ex cras nec scelerisque magna, eu dignissim ante. mauris ullamcorper neque sed dapibus scelerisque, vestibulum et auctor odio. Fusce dapibus tortor vel quam venenatis rutrum fusce sagittis mauris nisi, eu vulputate nisl lacinia at. Suspendisse potenti, nulla nisi mi, hendrerit vitae faucibus id, ultricies sit amet nisi.</p>-->
<!--                    </div>-->
<!--                </div>-->
            </div>

        </div>
    </div>
</section>


<!--<section class="ptb-70">
    <div class="container">
        <div class="team-part team-opt-1">
            <div class="heading-part  mb-30">
                <h2 class="main_title heading"><span>Our Team</span></h2>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-4 col-xs-6 plr-20">
                    <div class="team-item listing-effect col-sm-margin-b"> <img alt="Electrro" src="images/tm1.jpg">
                        <div class="team-item-detail">
                            <h3 class="sub-title listing-effect-title">Adamaris Corliss</h3>
                            <div class="listing-meta">Co-Founder</div>
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 plr-20">
                    <div class="team-item listing-effect col-sm-margin-b"> <img alt="Electrro" src="images/tm2.jpg">
                        <div class="team-item-detail">
                            <h3 class="sub-title listing-effect-title">Lusi Rose</h3>
                            <div class="listing-meta">Project Manager</div>
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 plr-20">
                    <div class="team-item listing-effect col-sm-margin-b"> <img alt="Electrro" src="images/tm3.jpg">
                        <div class="team-item-detail">
                            <h3 class="sub-title listing-effect-title">Adamaris Corliss</h3>
                            <div class="listing-meta">Co-Founder</div>
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 plr-20">
                    <div class="team-item listing-effect col-sm-margin-b"> <img alt="Electrro" src="images/tm4.jpg">
                        <div class="team-item-detail">
                            <h3 class="sub-title listing-effect-title">Adamaris Corliss</h3>
                            <div class="listing-meta">Co-Founder</div>
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 plr-20">
                    <div class="team-item listing-effect col-sm-margin-b"> <img alt="Electrro" src="images/tm1.jpg">
                        <div class="team-item-detail">
                            <h3 class="sub-title listing-effect-title">Adamaris Corliss</h3>
                            <div class="listing-meta">Co-Founder</div>
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 plr-20">
                    <div class="team-item listing-effect col-sm-margin-b"> <img alt="Electrro" src="images/tm2.jpg">
                        <div class="team-item-detail">
                            <h3 class="sub-title listing-effect-title">Lusi Rose</h3>
                            <div class="listing-meta">Project Manager</div>
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!-- CONTAINER END -->