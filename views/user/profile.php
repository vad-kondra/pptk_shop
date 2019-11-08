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
                        <div id="account-details" class="tab-pane fade active show">
                            <h3>Информация учетной записи</h3>
                            <div class="register-form login-form clearfix">

                                <?php $form = ActiveForm::begin()?>
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
                                        <?= Html::submitButton('Сохранить', ['class' => 'return-customer-btn f-right']) ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <div id="orders" class="tab-pane fade">
                            <h3>Ваши заказы</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Заказ №</th>
                                        <th>Дата </th>
                                        <th>Статус</th>
                                        <th>Сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($orders as $key => $order): ?>
                                        <tr>

                                            <td><?=Html::encode('#'.$order->id)?></td>
                                            <td><?=Html::encode($order->created_at)?></td>
                                            <td><?=OrderHelper::statusLabel($order->current_status)?></td>
                                            <td><?=PriceHelper::format($order->cost)?></td>
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

