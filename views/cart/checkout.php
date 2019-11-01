<?PHP

/* @var $this yii\web\View */
/* @var $cart Cart */
/* @var $model OrderForm */


$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['/cart']];
$this->params['breadcrumbs'][] = $this->title;

use app\helpers\PriceHelper;
use app\models\cart\Cart;
use app\models\OrderForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

?>

<!-- CONTAIN START -->
<section class="ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="heading-part mb-30">
                    <h2 class="main_title heading "><span><?= Html::encode($this->title)?></span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 mb-xs-30">
                <div class="cart-item-table commun-table mb-30">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Изображение</th>
                                <th>Название</th>
                                <th>Всего</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($cart->getItems() as $item): ?>
                                <?php
                                $product = $item->getProduct();
                                $url = Url::to(['/catalog/product', 'id' => $product->id]);
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?= $url ?>">
                                            <div class="product-image">
                                                <?php if ($product->photo):?>
                                                    <?= \yii\helpers\Html::img('/'.$product->photo->img_src) ?>
                                                <?php else: ?>
                                                    <?= Html::img('/images/empty-img.png') ?>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </td>
                                    <td><div class="product-title"> <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a> </div></td>
                                    <td>
                                        <div class="total-price price-box"> <span class="price"><?= PriceHelper::format($item->getCost()) ?> </span> </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="cart-total-table commun-table mb-30">
                    <div class="table-responsive">
                        <?php $cost = $cart->getCost() ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th colspan="2">Итого</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Общая сумма товаров</td>
                                <td><div class="price-box"> <span class="price"><?= PriceHelper::format($cost->getOrigin()) ?> </span> </div></td>
                            </tr>
                            <tr>
                                <td ><strong>Ваша скидка</strong></td>
                                <td ><?= Html::encode($cost->getDiscount()->getValue()*100) ?> %</td>
                            </tr>
                            <tr>
                                <td><b>К оплате</b></td>
                                <td><div class="price-box"> <span class="price"><b><?= PriceHelper::format($cost->getTotal()) ?> </b></span> </div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <?php $form = ActiveForm::begin(['class' => 'main-form full']) ?>
                <div class="mb-20">
                    <div class="row">
                        <div class="col-xs-12 mb-20">
                            <div class="heading-part">
                                <h3 class="sub-heading">Информация о заказчике</h3>
                            </div>
                            <hr>
                        </div>
                        <div class="col-xs-12 mb-20">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($model->customer, 'f_name') ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($model->customer, 'l_name') ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($model->customer, 'phone')->widget(MaskedInput::class, [
                                            'mask' => '+38 (099) 999-99-99','clientOptions'=>['clearIncomplete'=>true]]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($model->customer, 'email') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($model->customer, 'city') ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($model->customer, 'post_index') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-box">
                                        <?= $form->field($model->customer, 'address') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-box">
                                        <?= $form->field($model, 'comment')->textarea() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div> <a href="<?=Url::toRoute(['/catalog'])?>" class="btn btn-color"><span><i class="fa fa-angle-left"></i></span>Продолжить покупки</a> </div>
                </div>
                <div class="right-side">
                    <?= Html::submitButton('Оформить', ['class' => 'btn btn-color']) ?>
                </div>
                <?php $form = ActiveForm::end() ?>
            </div>
        </div>
    </div>
</section>
<!-- CONTAINER END -->