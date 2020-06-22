<?php

/* @var $this yii\web\View */
/* @var $product Product */


use app\helpers\PriceHelper;
use app\models\Config;
use app\models\Product;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $product->name . ' - ' . Config::getValue(Config::MAIN_SHORT_TITLE);

$this->registerMetaTag(['name' =>'title', 'content' => $product->meta->title . ' - ' . Config::getValue(Config::MAIN_SHORT_TITLE)]);
$this->registerMetaTag(['name' =>'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $product->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['active_category'] = $product->category;


?>

<div class="main-product-thumbnail pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="tab-content">
                    <?php
                    $img_src = null;
                    if(isset($product->photo)) {
                        $img_src = $product->photo->img_src;
                    }
                    echo Yii::$app->thumbnail->img($img_src, [
                        'placeholder' => [
                            'width' => 400,
                            'height' => 400
                        ],
                        'thumbnail' => [
                            'width' => 400,
                            'height' => 400,
                        ]
                    ]);
                    ?>

                </div>

            </div>
            <div class="col-lg-9">
                <div class="thubnail-desc fix">
                    <h3 class="product-header"><?= Html::encode($product->name) ?></h3>

                    <div class="pro-price mtb-10">
                        <p><span class="code">Код товара: <?= Html::encode($product->code) ?></span></p>
                        <p><span class="art">Артикул: <?= Html::encode($product->art) ?></span></p>
                        <p><span class="producer">Производитель: <a href="<?= Html::encode(Url::to(['/catalog/search', 'brand' => $product->brand->id])) ?>"><?= Html::encode($product->brand->name) ?></a></span></p>
                    </div>
                    <div class="pro-price mtb-10">
                        <p><span class="price">Цена: <?=PriceHelper::format($product->price_new) ?></span>
                            <?php if (isset($product->price_old)): ?>
                                <del class="prev-price"><?=PriceHelper::format($product->price_old) ?></del>
                            <?php endif;?>
                            <a class="add-cart" data-id="<?=$product->id?>">В корзину</a>
                        </p>

                    </div>
                </div>
            </div>
            <!-- Thumbnail Description End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail End -->
<!-- Product Thumbnail Description Start -->
<div class="thumnail-desc pb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="main-thumb-desc nav">
                    <li><a class="active" data-toggle="tab" href="#dtail">Описание</a></li>
                    <li><a data-toggle="tab" href="#review">Характеристики</a></li>
                </ul>
                <!-- Product Thumbnail Tab Content Start -->
                <div class="tab-content thumb-content border-default">
                    <div id="dtail" class="tab-pane in active">
                        <p>
                            <?php if ($product->description): ?>
                                <?= Yii::$app->formatter->asHtml($product->description, [
                                    'Attr.AllowedRel' => array('nofollow'),
                                    'HTML.SafeObject' => true,
                                    'Output.FlashCompat' => true,
                                    'HTML.SafeIframe' => true,
                                    'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                                ]) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div id="review" class="tab-pane ">
                        <div class="review">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <?php foreach ($product->values as $value): ?>
                                        <?php if (!empty($value->value)): ?>
                                            <tr>
                                                <td><?=Html::encode($value->characteristic->name)?></td>
                                                <td><?=Html::encode($value->value)?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Product Thumbnail Tab Content End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail Description End -->
