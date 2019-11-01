<?PHP


/* @var $this yii\web\View */
/* @var $profileInfoForm ProfileInfoForm */
/* @var $orders Order[] */
/* @var $profileChangePassForm ProfileChangePassForm */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] =  ['template' => "<li> <span>{link}</span></li>", 'label' => $this->title,];


use app\helpers\OrderHelper;
use app\helpers\PriceHelper;
use app\models\order\Order;
use app\models\profile\ProfileChangePassForm;
use app\models\profile\ProfileInfoForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>
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
                    <?php $form = ActiveForm::begin()?>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-box">
                                    <?= $form->field($profileChangePassForm, 'old_password')->passwordInput()->label(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-box">
                                    <?= $form->field($profileChangePassForm, 'new_password')->passwordInput()->label(); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-box">
                                    <?= $form->field($profileChangePassForm, 'repeat_password')->passwordInput()->label(); ?>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <?= Html::submitButton('Изменить пароль', ['class' => 'btn-color']) ?>
                            </div>
                        </div>
                    <?php $form = ActiveForm::end()?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTAINER END -->
