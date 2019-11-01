<?php
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li>/ <span>{link}</span></li>",
    'label' => $this->title,
];
?>

<!-- CONTAIN START -->
<section class="checkout-section ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2">
                            <?php
                            $form = \yii\bootstrap\ActiveForm::begin(['method'=>'POST','options'=>['id'=>'authForm','class'=>'main-form full']]);
                            ?>
                            <div class="row">
                                <div class="col-xs-12 mb-20">
                                    <div class="heading-part heading-bg">
                                        <h2 class="heading">Регистрация</h2>
                                    </div>
                                </div>

                                <div class="col-xs-12 mb-20">
                                    <?=$form->field($model, 'f_name')->textInput(['autofocus' => true]);?>
                                </div>

                                <div class="col-xs-12 mb-20">
                                    <?=$form->field($model, 'l_name')->textInput();?>
                                </div>
                                <div class="col-xs-12 mb-20">
                                    <?=$form->field($model, 'p_name')->textInput();?>
                                </div>

                                <div class="col-xs-12 mb-20">
                                    <?=$form->field($model, 'email')->textInput();?>
                                </div>
                                <div class="col-xs-12 mb-20">
                                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                                        'mask' => '+38 (099) 999-99-99','clientOptions'=>['clearIncomplete'=>true]]); ?>
                                </div>
                                <div class="col-xs-12 mb-20">
                                    <?=$form->field($model, 'password_hash')->passwordInput();?>
                                </div>
                                <div class="col-xs-12 mb-20 required">
                                    <?=$form->field($model, 'password_repeat')->passwordInput();?>
                                </div>
                                <div class="col-xs-12">
                                    <?=\yii\helpers\Html::submitButton('Зарегистрироваться', ['class'=>'btn-color right-side mb-2'])?>
                                </div>
                                <div class="col-xs-12">
                                    <hr>
                                    <div class="new-account align-center mt-20"> <span>Если уже есть учетная запись</span> <a class="link" title="Войти" href="<?=\yii\helpers\Url::to(['/sign-in'])?>">Войти</a> </div>
                                </div>
                            </div>
                        <?php $form = \yii\bootstrap\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTAINER END -->