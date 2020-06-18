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

<!-- checkout-area start -->
<div class="checkout-area pt-30  pb-60">
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form">
                        <h3>Информация о заказчике</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <?= $form->field($model->customer, 'f_name') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <?= $form->field($model->customer, 'l_name') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <?= $form->field($model->customer, 'phone')->widget(MaskedInput::class, [
                                        'mask' => '+38 (099) 999-99-99','clientOptions'=>['clearIncomplete'=>true]]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <?= $form->field($model->customer, 'email') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <?= $form->field($model->customer, 'city') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <?= $form->field($model->customer, 'post_index') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <?= $form->field($model->customer, 'address') ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <?= $form->field($model, 'comment')->textarea() ?>
                                </div>
                            </div>
                            <?php if (Yii::$app->user->isGuest): ?>
                                <div class="col-md-12">
                                    <div class="checkout-form-list create-acc mb-30">
                                        <input id="cbox" type="checkbox" />
                                        <label>Постоянный клиент?</label>
                                    </div>
                                    <div id="cbox_info" class="checkout-form-list create-accounts mb-25">
                                        <p class="mb-10">Если у Вас уже есть учетная запись -  <a class="link" title="Войти" href="<?=\yii\helpers\Url::to(['/sign-in'])?>">войдите на странице входа</a> </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="your-order">
                        <h3>Ваш заказ</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-name">Товар</th>
                                    <th class="product-total">Всего</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart->getItems() as $item): ?>
                                    <?php
                                    $product = $item->getProduct();
                                    $url = Url::to(['/catalog/product', 'id' => $product->id]);
                                    ?>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                <?= Html::encode($product->name) ?> <strong class="product-quantity"> × 1</strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount"><?= PriceHelper::format($item->getCost()) ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                <?php $cost = $cart->getCost() ?>
                                <tr class="cart-subtotal">
                                    <th>В корзине всего</th>
                                    <td><span class="amount"></span><?= PriceHelper::format($cost->getOrigin()) ?></td>
                                </tr>
                                <tr class="cart-subtotal">
                                    <th>Ваша скидка</th>
                                    <td><span class="amount"><?= Html::encode($cost->getDiscount()->getValue()*100) ?>%</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Заказ на сумму</th>
                                    <td><strong><span class="amount"><?= PriceHelper::format($cost->getTotal()) ?></span></strong>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
<!--                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">-->
<!--                                    <div class="panel panel-default">-->
<!--                                        <div class="panel-heading" role="tab" id="headingOne">-->
<!--                                            <h4 class="panel-title">-->
<!--                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">-->
<!--                                                    Direct Bank Transfer-->
<!--                                                </a>-->
<!--                                            </h4>-->
<!--                                        </div>-->
<!--                                        <div id="collapseOne" class="panel-collapse collapse  in show" role="tabpanel" aria-labelledby="headingOne">-->
<!--                                            <div class="panel-body">-->
<!--                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="panel panel-default">-->
<!--                                        <div class="panel-heading" role="tab" id="headingTwo">-->
<!--                                            <h4 class="panel-title">-->
<!--                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">-->
<!--                                                    Cheque Payment-->
<!--                                                </a>-->
<!--                                            </h4>-->
<!--                                        </div>-->
<!--                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">-->
<!--                                            <div class="panel-body">-->
<!--                                                <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="panel panel-default">-->
<!--                                        <div class="panel-heading" role="tab" id="headingThree">-->
<!--                                            <h4 class="panel-title">-->
<!--                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">-->
<!--                                                    PayPal-->
<!--                                                </a>-->
<!--                                            </h4>-->
<!--                                        </div>-->
<!--                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">-->
<!--                                            <div class="panel-body">-->
<!--                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="order-button-payment">
                                    <input type="submit" value="Разместить заказ" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- checkout-area end -->