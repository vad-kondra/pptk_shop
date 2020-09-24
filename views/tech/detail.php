<?php

use app\models\tech\Tech;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $techArticles Tech */

$this->title = $techArticles->title;
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <div class="row">
        <div class="detail-news-wrapper mb-5">
            <h1 class="text-center mb-4"><?=$techArticles->title ?></h1>
            <div class="detail-news-body">
<!--                <div class="left-inner-detail-news">-->
<!--                    <div class="detail-news-img">-->
<!--                        --><?php
//                        $img_src = null;
//                        if(isset($techArticles->photo) && file_exists($techArticles->photo->img_src)) {
//                            $img_src = ($techArticles->photo->img_src);
//                        }
//                        echo Yii::$app->thumbnail->img($img_src, [
//                            'placeholder' => [
//                                'width' => 400,
//                                'height' => 400
//                            ],
//                            'thumbnail' => [
//                                'width' =>400,
//                                'height' => 400,
//                            ]
//                        ]);
//                        ?>
<!--                    </div>-->
<!--                </div>-->
                <div class="detail-news-text ml-md-5">
                    <?= Html::decode($techArticles->body) ?>
                </div>
            </div>
        </div>
    </div>
</div>
