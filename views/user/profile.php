<?PHP

use app\helpers\OrderHelper;
use app\helpers\PriceHelper;
use app\models\Config;
use app\models\order\Order;
use app\models\profile\ProfileChangePassForm;
use app\models\profile\ProfileInfoForm;
use app\models\user\User;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $user User */
/* @var $profileInfoForm ProfileInfoForm */
/* @var $orders Order[] */
/* @var $profileChangePassForm ProfileChangePassForm */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] =  ['label' => $this->title,];


?>


<!-- My Account Page Start Here -->
<div class="my-account white-bg pb-60">
    <div class="container">
        <div class="account-dashboard">
            <div class="dashboard-upper-info">
                <div class="row no-gutters align-items-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="d-single-info">
                            <p class="user-name">Привет, <span><?=Html::encode($user->getFullName())?></span></p>
                            <p>(не <?=Html::encode($user->getFullName())?>? <a href="<?=Url::to('/logout')?>">Выход</a>)</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="d-single-info">
                            <p>Нужна помощь? эл.адрес технической поддержки </p>
                            <?=Html::mailto(Config::getValue(Config::MAIN_EMAIL)) ?>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="d-single-info text-center">
                            <a class="view-cart" href="<?=Url::to('/cart')?>"><i class="fa fa-cart-plus" aria-hidden="true"></i>Ваша корзина</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <!-- Nav tabs -->
                    <ul class="nav flex-column dashboard-list" role="tablist">
                        <li><a class="active"data-toggle="tab" href="#account-details">Детальная информация</a></li>
                        <li><a data-toggle="tab" href="#orders">Заказы</a></li>
                        <li><a data-toggle="tab" href="#change-password">Изменить пароль</a></li>
                        <li><a data-method="post" href="<?=Url::to('/logout')?>">Выход</a></li>
                    </ul>
                </div>
                <div class="col-lg-10">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content mt-all-40">
                        <div id="account-details" class="tab-pane fade">
                            <h3>Account details </h3>
                            <div class="register-form login-form clearfix">
                                <form action="#">
                                    <div class="form-group row align-items-center">
                                        <label class="col-lg-3 col-md-4 col-form-label">Social title</label>
                                        <div class="col-lg-6 col-md-8">
                                            <span class="custom-radio"><input name="id_gender" value="1" type="radio"> Mr.</span>
                                            <span class="custom-radio"><input name="id_gender" value="1" type="radio"> Mrs.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="f-name" class="col-lg-3 col-md-4 col-form-label">First Name</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="f-name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="l-name" class="col-lg-3 col-md-4 col-form-label">Last Name</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="l-name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-lg-3 col-md-4 col-form-label">Email address</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputpassword" class="col-lg-3 col-md-4 col-form-label">Current password</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="password" class="form-control" id="inputpassword">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpassword" class="col-lg-3 col-md-4 col-form-label">New password</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="password" class="form-control" id="newpassword">
                                            <button class="btn show-btn" type="button">Show</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="v-password" class="col-lg-3 col-md-4 col-form-label">Confirm password</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="password" class="form-control" id="c-password">
                                            <button class="btn show-btn" type="button">Show</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="birth" class="col-lg-3 col-md-4 col-form-label">Birthdate</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="birth" placeholder="MM/DD/YYYY">
                                        </div>
                                    </div>
                                    <div class="form-check row p-0 mt-20">
                                        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-4">
                                            <input class="form-check-input" value="#" id="offer" type="checkbox">
                                            <label class="form-check-label" for="offer">Receive offers from our partners</label>
                                        </div>
                                    </div>
                                    <div class="form-check row p-0 mt-20">
                                        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-4">
                                            <input class="form-check-input" value="#" id="subscribe" type="checkbox">
                                            <label class="form-check-label" for="subscribe">Sign up for our newsletter<br>Subscribe to our newsletters now and stay up-to-date with new collections, the latest lookbooks and exclusive offers..</label>
                                        </div>
                                    </div>
                                    <div class="register-box mt-40">
                                        <button type="submit" class="return-customer-btn f-right">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="orders" class="tab-pane fade">
                            <h3>Ваши заказы</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Заказ №</th>
                                        <th>Дата</th>
                                        <th>Статус</th>
                                        <th>Всего</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($orders as $key => $order): ?>
                                        <tr>

                                            <td><?=Html::encode('#'.$order->id)?></td>
                                            <td><?=Html::encode($order->created_at)?></td>
                                            <td><?=OrderHelper::statusLabel($order->current_status)?></td>
                                            <td><?=PriceHelper::format($order->cost)?> за <?=Html::encode(count($order->items))?> товар </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="change-password" class="tab-pane fade">
                            <h3>Изменение пароля</h3>
                            <div>
                                <?php $form = ActiveForm::begin()?>
                                <div class="col-lg-6">
                                    <?= $form->field($profileChangePassForm, 'old_password')->passwordInput()->label(); ?>
                                </div>

                                <div class="col-lg-6">
                                    <?= $form->field($profileChangePassForm, 'new_password')->passwordInput()->label(); ?>
                                </div>
                                <div class="col-lg-6">
                                    <?= $form->field($profileChangePassForm, 'repeat_password')->passwordInput()->label(); ?>
                                </div>
                                <div class="col-lg-12">
                                    <?= Html::submitButton('Изменить пароль', ['class'=>'return-customer-btn']) ?>
                                </div>
                                <?php $form = ActiveForm::end()?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Account Page End Here -->


<!-- CONTAIN START -->
<section class="checkout-section ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="account-sidebar account-tab mb-xs-30">
                    <div class="dark-bg tab-title-bg">
                        <div class="heading-part">
                            <div class="sub-title"><span></span> Мой Профиль</div>
                        </div>
                    </div>
                    <div class="account-tab-inner">
                        <ul class="account-tab-stap">
                            <li id="step1"> <a href="javascript:void(0)">Информация<i class="fa fa-angle-right"></i> </a> </li>
                            <li id="step2" class="active"> <a href="javascript:void(0)">Мои заказы<i class="fa fa-angle-right"></i> </a> </li>
                            <li id="step3"> <a href="javascript:void(0)">Пароль<i class="fa fa-angle-right"></i> </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <div id="data-step1" class="account-content" data-temp="tabdata" style="display:none">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="heading-part heading-bg mb-30">
                                <h2 class="heading m-0">Информация профиля</h2>
                            </div>
                        </div>
                    </div>
                    <div class="m-0">
                        <?php $form = ActiveForm::begin()?>
                        <div class="mb-20">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-box">
                                        <?= $form->field($profileInfoForm, 'username')->textInput([$profileInfoForm->username]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($profileInfoForm, 'f_name')->textInput([$profileInfoForm->f_name]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($profileInfoForm, 'l_name')->textInput([$profileInfoForm->l_name]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($profileInfoForm, 'p_name')->textInput([$profileInfoForm->p_name]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($profileInfoForm, 'email')->textInput([$profileInfoForm->email]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($profileInfoForm, 'company')->textInput([$profileInfoForm->company ]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-box">
                                        <?= $form->field($profileInfoForm, 'phone')->widget(MaskedInput::class, [
                                            'mask' => '+38 (099) 999-99-99','clientOptions'=>['clearIncomplete'=>true]]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <?= Html::submitButton('Сохранить', ['class' => 'btn-color']) ?>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div id="data-step2" class="account-content" data-temp="tabdata" >
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="heading-part heading-bg mb-30">
                                <h2 class="heading m-0">Мои заказы</h2>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($orders as $key => $order): ?>
                    <div class="row">
                        <div class="col-xs-12 ">

                            <div class="cart-item-table commun-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="4"> <ul>
                                                        <li><span>Заказ размещен</span> <span><?=Html::encode($order->created_at)?></span></li>
                                                        <li><span>Статус</span> <span><?=OrderHelper::statusLabel($order->current_status)?></span></li>
                                                        <li class="price-box"><span>Всего на сумму</span> <span class="price"><?=PriceHelper::format($order->cost)?></span></li>
                                                        <li><span>Заказ №</span> <span><?=Html::encode('#'.$order->id)?></span></li>
                                                    </ul>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($order->items as $item):?>
                                            <tr>
                                                <td>
                                                    <a href="<?= Url::to(['/catalog/product', 'id' => $item->product->id]) ?>">
                                                        <div class="product-image">
                                                            <img src="<?= Html::encode("/".$item->product->photo->img_src) ?>">
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><div class="product-title"> <a href="<?= Url::to(['/catalog/product', 'id' => $item->product->id]) ?>"><?=Html::encode($item->product_name)?></a> </div>
                                                    <div class="product-info-stock-sku m-0">
                                                        <div>
                                                            <label>Количество: </label>
                                                            <span class="info-deta"><?=Html::encode($item->quantity)?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><div class="base-price price-box"> <span class="price"><?=PriceHelper::format($item->getCost())?></span> </div></td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                    <br/>
                    <?php endforeach; ?>
                </div>
                <div id="data-step3" class="account-content" data-temp="tabdata" style="display:none">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="heading-part heading-bg mb-30">
                                <h2 class="heading m-0">Изменить пароль</h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTAINER END -->
