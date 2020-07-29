<?php

use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider DataProviderInterface */

?>



<!-- Grid & List View Start -->
<div class="grid-list-top border-default universal-padding fix mb-30">
    <div class="grid-list-view f-left">
        <ul class="list-inline nav">
<!--            <li><a data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>-->
<!--            <li><a  class="active" data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>-->
            <li><span class="grid-item-list"> Показано <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></span></li>
        </ul>
    </div>
    <!-- Toolbar Short Area Start -->
    <div class="main-toolbar-sorter f-right">
        <div class="toolbar-sorter">
            <label>Сортировать</label>

            <select class="sorter" name="sorter" onchange="location = this.value;">
                <?php
                $values = [
                    '' => 'По умолчанию',
                    'name' => 'По названию (А - Я)',
                    '-name' => 'По названию (Я - А)',
                    'price' => 'По возрастанию цены',
                    '-price' => 'По убыванию цены',
                ];
                $current = Yii::$app->request->get('sort');
                ?>
                <?php foreach ($values as $key => $label): ?>
                    <option value="<?= Html::encode(Url::current(['sort' => $key ?: null])) ?>" <?php if ($current == $key): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
<!--            <span><a href="#"><i class="fa fa-arrow-up"></i></a></span>-->
        </div>
    </div>
    <!-- Toolbar Short Area End -->
</div>
<!-- Grid & List View End -->
<div class="main-categorie">
    <!-- Grid & List Main Area End -->
    <div class="tab-content fix">
<!--        <div id="grid-view" class="tab-pane ">-->
<!--            <div class="row">-->
<!--                --><?php //foreach ($products as $product): ?>
<!--                    --><?//= $this->render('_product_grid_view', [
//                        'product' => $product
//                    ]) ?>
<!--                --><?php //endforeach; ?>
<!--            </div>-->
<!--        </div>-->
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
    <?= LinkPager::widget([
        'pagination' => $dataProvider->getPagination(),
        'options' => [
            'class' => 'blog-pagination',
        ],
        'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
        'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
        'maxButtonCount' => 5,
    ]) ?>
<!--    <div class="toolbar-sorter-footer">-->
<!--        <label>Вывести по</label>-->
<!--        <select class="sorter" name="sorter">-->
<!--            <option value="Position" selected="selected">12</option>-->
<!--            <option value="Product Name">15</option>-->
<!--            <option value="Price">30</option>-->
<!--        </select>-->
<!--        <span>per page</span>-->
<!--    </div>-->
</div>
<!--Breadcrumb and Page Show End -->




