<?php

/* @var $this yii\web\View */
/* @var $dataProvider DataProviderInterface */

use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>



<!-- Grid & List View Start -->
<div class="grid-list-top border-default universal-padding fix mb-30">
    <div class="grid-list-view f-left">
        <ul class="list-inline nav">
            <li><a data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
            <li><a  class="active" data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
            <li><span class="grid-item-list"> Показано 1-12 из 13</span></li>
        </ul>
    </div>
    <!-- Toolbar Short Area Start -->
    <div class="main-toolbar-sorter f-right">
        <div class="toolbar-sorter">
            <label>Сортировать</label>
            <select class="sorter" name="sorter">
                <option value="Position" selected="selected">position</option>
                <option value="Product Name">Product Name</option>
                <option value="Price">Price</option>
            </select>
            <span><a href="#"><i class="fa fa-arrow-up"></i></a></span>
        </div>
    </div>
    <!-- Toolbar Short Area End -->
</div>
<!-- Grid & List View End -->
<div class="main-categorie">
    <!-- Grid & List Main Area End -->
    <div class="tab-content fix">
        <div id="grid-view" class="tab-pane ">
            <div class="row">
                <?php foreach ($dataProvider->getModels() as $product): ?>
                    <?= $this->render('_product_grid_view', [
                        'product' => $product
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- #grid view End -->
        <div id="list-view" class="tab-pane active">
            <div class="row">
                <?php foreach ($dataProvider->getModels() as $product): ?>
                    <?= $this->render('_product_list_view', [
                        'product' => $product
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- #list view End -->
    </div>
    <!-- Grid & List Main Area End -->
</div>
<!--Breadcrumb and Page Show Start -->
<div class="pagination-box fix">
    <ul class="blog-pagination ">
        <li><a href="#">1</a></li>
        <li class="active"><a href="#">2</a></li>
        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
    </ul>
    <div class="toolbar-sorter-footer">
        <label>Вывести по</label>
        <select class="sorter" name="sorter">
            <option value="Position" selected="selected">12</option>
            <option value="Product Name">15</option>
            <option value="Price">30</option>
        </select>
        <span>per page</span>
    </div>
</div>
<!--Breadcrumb and Page Show End -->




