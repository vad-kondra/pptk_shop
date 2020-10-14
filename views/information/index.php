<?php

use app\models\information\Information;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $informationArticles Information[] */

$this->title = 'Полезная  информация';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <?php foreach ($informationArticles as $item):?>
        <div class="news-main-wrapper">
            <div class="row mb-5 mt-5 news-item-wrapper">
                <div class="news-left-info-wrapper col-lg-4 col-7">
                    <div class="photo-news-inner">
                        <?php
                        $img_src = null;
                        if(isset($item->photo) && file_exists($item->photo->img_src)) {
                            $img_src = Html::encode($item->photo->img_src);
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
                </div>
                <div class="body-news-inner col-lg-8 col-12">
                    <div class="text-block">
                        <div class="news-title">
                            <h2><?=$item->title?></h2>
                        </div>
                        <div class="news-text-body">
                            <?=$item->short_desc?>
                        </div>
                    </div>
                    <div class="date-info-inner">
                        <div class="btn-read-more">
                            <a href="<?= Url::to(['/information/view', 'slug' => $item->slug]) ?>">Читать далее</a>
                        </div>
                        <div class="publication-news-date">
                            <span>Дата Публикации:
                            <?= date("d-m-Y", $item->created_at) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>


