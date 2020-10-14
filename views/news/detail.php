<?php

use app\models\news\News;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $news News */

$this->title = $news->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $news->title;
?>

<div class="container">
    <div class="row">
            <div class="detail-news-wrapper mb-5">
                <h1 class="text-center mb-4"><?=$news->title ?></h1>
                <div class="detail-news-body">
                    <div class="left-inner-detail-news">
                        <div class="detail-news-img">
                            <?php
                            $img_src = null;
                            if(isset($news->photo) && file_exists($news->photo->img_src)) {
                                $img_src = ($news->photo->img_src);
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
                        <div class="detail-news-date mt-4">
                            <span>Дата создания: <?= Yii::$app->formatter->asDate($news->created_at)?></span><br>
                            <span>Дата Публикации: <?= Yii::$app->formatter->asDate($news->publish_at)?></span>
                        </div>
                    </div>
                    <div class="detail-news-text ml-md-5">
                        <?= Html::encode($news->body) ?>
                    </div>
                </div>
            </div>
    </div>
</div>
