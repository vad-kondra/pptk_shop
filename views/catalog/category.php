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

<section class="ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 mb-sm-30 col-lgmd-20per">
                <div class="sidebar-block">
                    <?= $this->render('_subcategories', [
                        'category' => $category
                    ]) ?>
                </div>
            </div>
            <div class="col-lg-10 col-md-9 col-lgmd-80per">
                <?php if (trim($category->description)): ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?= Yii::$app->formatter->asHtml($category->description, [
                                'Attr.AllowedRel' => array('nofollow'),
                                'HTML.SafeObject' => true,
                                'Output.FlashCompat' => true,
                                'HTML.SafeIframe' => true,
                                'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                            ]) ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?= $this->render('_list', [
                    'dataProvider' => $dataProvider
                ]) ?>
            </div>
        </div>
    </div>
</section>





