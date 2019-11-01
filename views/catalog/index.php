<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category app\models\Category */


use yii\helpers\Html;

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 mb-sm-30 col-lgmd-20per">
                <div class="sidebar-block">
                    <?= $this->render('_subcategories', [
                        'category' => $category
                    ]) ?>
                    <div class="sidebar-box mb-40"> <span class="opener plus"></span>
                        <div class="sidebar-title">
                            <h3>Фильтры</h3> <span></span>
                        </div>
                        <div class="sidebar-contant">
                            <div class="price-range mb-30">
                                <div class="price-range mb-30">
                                    <div class="inner-title">Цена</div>
                                    <input class="price-txt" type="text" id="amount">
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                            <div class="size mb-20">
                                <div class="inner-title">Размер</div>
                                <ul >
                                    <li><a href="#">S (10)</a></li>
                                    <li><a href="#">M (05)</a></li>
                                    <li><a href="#">L (10)</a></li>
                                    <li><a href="#">XL (08)</a></li>
                                    <li><a href="#">XXL (05)</a></li>
                                </ul>
                            </div>

                            <div class="mb-20">
                                <div class="inner-title">Еще характеристика</div>
                                <ul>
                                    <li><a>характеристика_01 <span>(0)</span></a></li>
                                    <li><a>характеристика_02 <span>(5)</span></a></li>
                                    <li><a>характеристика_03 <span>(10)</span></a></li>
                                </ul>
                            </div>
                        </div>
                        </div>

                </div>
            </div>
            <div class="col-lg-10 col-md-9 col-lgmd-80per">
                <?= $this->render('_list', [
                        'dataProvider' => $dataProvider
                ]) ?>
            </div>
        </div>
    </div>
</section>
