<?php

/* @var $news News[] */

use app\models\news\News;
use yii\bootstrap\Html;

?>

<!-- SUB-BANNER START -->
<div class="sub-banner-block pt-70 mb-5">
    <div class="container">
        <div class=" center-sm">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="heading-part mb-30  mb-xs-15">
                        <h2 class="main_title heading"><span>Новости</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($news as $item): ?>
                <div class="col-md-4">
                    <?=Html::beginTag('a', ['href' => '/news?id='.$item->id])?>
                        <div class="sub-banner sub-banner1" >
                            <?php if ($item->photo):?>
                                <img src="<?= Html::encode("/".$item->photo->img_src) ?>" alt="<?= Html::encode($item->title) ?>">
                            <?php else: ?>
                                <img src="images/sub-banner1.jpg" >
                            <?php endif; ?>
                            <div class="sub-banner-detail">
                                <div class="sub-banner-title sub-banner-title-color"><?=Html::encode($item->title)?></div>
                            </div>
                        </div>
                    <?=Html::endTag('a')?>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
<!-- SUB-BANNER END -->