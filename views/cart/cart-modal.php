<?php

/* @var $this yii\web\View */
/* @var $cart Cart */

use app\helpers\PriceHelper;
use app\models\cart\Cart;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;

$count = count($cart->getItems());

?>

<?php if ($count > 0): ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Название</th>
                <th>Цена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart->getItems() as $item): ?>
                <?php
                $product = $item->getProduct();
                $url = Url::to(['/catalog/product', 'id' => $product->id]); ?>
                <tr>
                    <td>
                        <a href="<?= $url ?>">
                            <div class="product-image">
                                <?php if ($product->photo):?>
                                    <?= Yii::$app->thumbnail->img($product->photo->img_src, [
                                        'thumbnail' => [
                                            'width' => 100,
                                            'height' => 100,
                                        ],
                                        'placeholder' => [
                                            'width' => 100,
                                            'height' => 100
                                        ]
                                    ]); ?>
                                <?php else: ?>
                                    <?= Html::img('/images/empty-img.png', ['width' => '100px', 'height' => '100px']) ?>
                                <?php endif; ?>
                            </div>
                        </a>
                    </td>
                    <td><div class="product-title"> <a href="<?=$url?>"><?= Html::encode($product->name) ?></a> </div></td>
                    <td>
                        <div class="total-price price-box"> <span class="price"><?= PriceHelper::format($item->getCost()) ?> </span> </div>
                    </td>
                    <td>
                        <span class="glyphicon glyphicon-trash text-danger del-item deleteFromCartButton" data-id="<?=$item->getId()?>" title="Удалить товар из корзины"></span>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="cart-total-table commun-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="2">Итого</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Общая сумма товаров</td>
                            <td><div class="price-box"> <span class="price"><?= PriceHelper::format($cart->getCost()->getOrigin()) ?> </span> </div></td>
                        </tr>
                        <tr>
                            <td ><strong>Ваша скидка</strong></td>
                            <td ><?= Html::encode($cart->getCost()->getDiscount()->getValue()*100) ?> %</td>
                        </tr>
                        <tr>
                            <td><b>К оплате</b></td>
                            <td><div class="price-box"> <span class="price"><b><?= PriceHelper::format($cart->getCost()->getTotal()) ?> </b></span> </div></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <h3 align="center">Ваша корзина пуста</h3>
<?php endif;?>
<div class="row">
    <div class="col-sm-6">
        <div> <a href="<?=Url::toRoute(['/catalog'])?>" class="btn btn-color"><span><i class="fa fa-angle-left"></i></span>Продолжить покупки</a> </div>
    </div>
    <?php if ($count > 0): ?>
    <div class="col-sm-6">
        <div class="right-side float-none-xs"> <a href="<?=Url::toRoute(['/checkout'])?>" class="btn btn-color">Оформить заказ<span><i class="fa fa-angle-right"></i></span></a> </div>
    </div>
    <?php endif; ?>
</div>
