<?php

/* @var $news News[] */
/* @var $header string */

use app\models\news\News;
use yii\bootstrap\Html;

?>

<div class="new-pro-content news-wrapper">
    <div class="pro-tab-title border-line">
        <ul class="nav news-list news-tab-list">
            <li><a class="active" data-toggle="tab" href="#new-arrival"><?=$header?></a></li>
        </ul>
    </div>
    <div class="news-tab-content jump">
        <div id="new-arrival" class="news-pane-active">
            <?php foreach ($news as $item): ?>
            <div class="news-elem col-lg-4 col-10">
                <?=Html::beginTag('a', ['href' => '/news/view?id='.$item->id])?>
                <div class="sub-banner sub-banner1" >
                    <div class="img-wrap">
                        <?php
                        $img_src = null;
                        if(isset($item->photo) && file_exists($item->photo->img_src)) {
                            $img_src = ($item->photo->img_src);
                        }
                        echo Yii::$app->thumbnail->img($img_src, [
                            'placeholder' => [
                                'width' => 400,
                                'height' => 400
                            ],
                            'thumbnail' => [
                                'width' =>400,
                                'height' => 400,
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="sub-banner-detail">
                        <div class="sub-banner-title sub-banner-title-color">
                            <?=Html::encode($item->title)?>
                        </div>
                        <?=Html::endTag('a')?>

                        <?=Html::beginTag('a', ['href' => '/news/view?id='.$item->id, 'class' => 'short-desc-text'])?>
                        <div class="sub-banner-short-desc">
                            <?=Html::encode($item->short_desc)?>
                        </div>
                        <?=Html::endTag('a')?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>