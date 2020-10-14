<?php

use app\models\information\Information;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $informationArticles Information */

$this->title = $informationArticles->title;
$this->params['breadcrumbs'][] = ['label' => 'Полезная информация', 'url' => ['index']];
$this->params['breadcrumbs'][] = $informationArticles->title;

?>

<div class="container">
    <div class="row">
        <div class="detail-news-wrapper mb-5">
            <h1 class="text-center mb-4"><?=$informationArticles->title ?></h1>
            <div class="detail-news-body">
<!--                <div class="left-inner-detail-news">-->
<!--                    <div class="detail-news-img">-->
<!--                        --><?php
//                        $img_src = null;
//                        if(isset($informationArticles->photo) && file_exists($informationArticles->photo->img_src)) {
//                            $img_src = ($informationArticles->photo->img_src);
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
                    <?= Html::decode($informationArticles->body) ?>
                </div>
            </div>
        </div>
    </div>
</div>
