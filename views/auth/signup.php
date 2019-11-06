<?php
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html; ?>


<!-- Register Account Start -->
<div class="register-account pb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="register-title">
                    <h3 class="mb-10">РЕГИСТРАЦИЯ </h3>
                    <p class="mb-10">Если у Вас уже есть учетная запись -  <a class="link" title="Войти" href="<?=\yii\helpers\Url::to(['/sign-in'])?>">войдите на странице входа</a> </p>
                </div>
            </div>
        </div>
        <!-- Row End -->
        <div class="row">
            <div class="col-sm-12">
                <?php $form = ActiveForm::begin(['method'=>'POST','options'=>['id'=>'authForm','class'=>'form-vertical']]); ?>
                    <fieldset>
                        <legend>Ваши личные данные</legend>


                        <div class="row">
                            <div class="col-sm-10 col-lg-6">
                                <?=$form->field($model, 'f_name')->textInput(['autofocus' => true]);?>
                            </div>
                            <div class="col-sm-10 col-lg-6">
                                <?=$form->field($model, 'l_name')->textInput();?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-lg-6">
                                <?=$form->field($model, 'p_name')->textInput();?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 col-lg-6">
                                <?=$form->field($model, 'email')->textInput();?>
                            </div>
                            <div class="col-sm-10 col-lg-6">
                                <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                                    'mask' => '+38 (099) 999-99-99','clientOptions'=>['clearIncomplete'=>true]]); ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Ваш пароль</legend>
                        <div class="row">
                            <div class="col-sm-10 col-lg-6">
                                <?=$form->field($model, 'password_hash')->passwordInput();?>
                            </div>
                            <div class="col-sm-10 col-lg-6">
                                <?=$form->field($model, 'password_repeat')->passwordInput();?>
                            </div>
                        </div>
                    </fieldset>
                    <div class="buttons newsletter-input">
                        <div class="pull-right">Я прочитал и согласен с <a href="#" class="agree"><b>политикой конфиденциальности</b></a>
                            <input type="checkbox" name="agree" value="1"> &nbsp;

                            <?=Html::submitButton('Продолжить', ['class'=>'newsletter-btn'])?>
                        </div>
                    </div>
                <?php $form = ActiveForm::end(); ?>
                <p class="mb-10">Если у Вас уже есть учетная запись -  <a class="link" title="Войти" href="<?=\yii\helpers\Url::to(['/sign-in'])?>">войдите на странице входа</a> </p>

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Register Account End -->
