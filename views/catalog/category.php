<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $products Product[] */
/* @var $category Category */

use app\models\Category;
use app\models\Config;
use app\models\Product;

$this->title = $category->name . ' - ' . Config::getValue(Config::MAIN_SHORT_TITLE);
if ($category->isRoot()) {
    $this->title = 'Каталог товаров';
}

$this->registerMetaTag(['name' =>'name', 'content' => $category->meta->title . ' - ' . Config::getValue(Config::MAIN_SHORT_TITLE)]);
$this->registerMetaTag(['name' =>'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];

foreach ($category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
if (!$category->isRoot()) {
    $this->params['breadcrumbs'][] = $category->name;
}
?>

<!-- Shop Page Start -->
<div class="main-shop-page pb-60">
    <div class="container">
        <!-- Row End -->
        <div class="row">
            <!-- Sidebar Shopping Option Start -->
            <div class="col-lg-3  order-2">
                <div class="sidebar white-bg">
                    <div class="single-sidebar">
                        <?= $this->render('_subcategories', [
                            'category' => $category
                        ]) ?>
                    </div>

                </div>
            </div>
            <!-- Sidebar Shopping Option End -->
            <!-- Product Categorie List Start -->
            <div class="col-lg-9 order-lg-2">
                <?= $this->render('_list', [
                    'dataProvider' => $dataProvider
                ]) ?>
            </div>
            <!-- product Categorie List End -->

        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Shop Page End -->


