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

<!-- CONTAIN START -->
<section class="pt-70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 col-sm-5 mb-xs-30 mb-md-5">
                        <?php if ($product->photo):?>
                            <?= Yii::$app->thumbnail->img($product->photo->img_src, [
                                'thumbnail' => [
                                    'width' => 500,
                                    'height' => 500,
                                ],
                                'placeholder' => [
                                    'width' => 100,
                                    'height' => 100
                                ]
                            ]); ?>
                        <?php else: ?>
                            <?= Yii::$app->thumbnail->img('/images/empty-img.png', [
                                'thumbnail' => [
                                    'width' => 200,
                                    'height' => 200,
                                ],
                                'placeholder' => [
                                    'width' => 200,
                                    'height' => 200
                                ]
                            ]); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-9 col-sm-7">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="product-detail-main">
                                    <div class="product-item-details">
                                        <h1 class="product-item-name"><?= Html::encode($product->name) ?></h1>
                                        <div class="row product-info">
                                            <div class="col-md-6">
                                                <div class="product-info-stock-sku">
                                                    <div>
                                                        <label>Код товара: </label>
                                                        <span class="info-deta"><?= Html::encode($product->code) ?></span>
                                                    </div>
                                                </div>
                                                <div class="product-info-stock-sku">
                                                    <div>
                                                        <label>Артикул: </label>
                                                        <span class="info-deta"><?= Html::encode($product->art) ?></span>
                                                    </div>
                                                </div>
                                                <div class="product-info-stock-sku">
                                                    <div>
                                                        <label>Производитель:</label>
                                                        <span class="info-deta"><a href="<?= Html::encode(Url::to(['/catalog/search', 'brand' => $product->brand->id])) ?>"><?= Html::encode($product->brand->name) ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="price-box">
                                                            <span class="price">Цена: <?= PriceHelper::format($product->price_new) ?> </span>
                                                            <?php if (isset($product->price_old)): ?>
                                                                <del class="price old-price"><?= PriceHelper::format($product->price_old) ?> </del>
                                                            <?php endif;?>
                                                        </div>
                                                        <!--                                            <div class="product-qty">-->
                                                        <!--                                                <label for="qty">шт:</label>-->
                                                        <!--                                                <div class="custom-qty">-->
                                                        <!--                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>-->
                                                        <!--                                                    <input type="text" class="input-text qty" title="Qty" value="1" maxlength="8" id="qty" name="qty">-->
                                                        <!--                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>-->
                                                        <!--                                                </div>-->
                                                        <!--                                            </div>-->
                                                        <div class="bottom-detail cart-button">
                                                            <ul>
                                                                <li class="pro-cart-icon">
                                                                    <button class="btn-color addToCartButton" href="<?= Url::to(['/cart/add', 'id' => $product->id]) ?>" data-id="<?=$product->id?>"><span></span>В корзину</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <section class="ptb-70">

                                <?php
                                $haveDescr = isset($product->description);
                                ?>
                                <div class="container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-specification" data-toggle="tab">Характеристики</a></li>
                                        <?php if ($haveDescr): ?>
                                            <li ><a href="#tab-description" data-toggle="tab">Описание</a></li>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-specification">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                            <?php foreach ($product->values as $value): ?>
                                                                <?php if (!empty($value->value)): ?>
                                                                    <tr>
                                                                        <th><?= Html::encode($value->characteristic->name) ?></th>
                                                                        <td><?= Html::encode($value->value) ?></td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-description">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="description">
                                                        <?php if ($haveDescr): ?>
                                                            <?= Yii::$app->formatter->asHtml($product->description, [
                                                                'Attr.AllowedRel' => array('nofollow'),
                                                                'HTML.SafeObject' => true,
                                                                'Output.FlashCompat' => true,
                                                                'HTML.SafeIframe' => true,
                                                                'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                                                            ]) ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<!-- CONTAINER END -->



