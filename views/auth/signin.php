<?PHP
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li><span>{link}</span></li>",
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
                        <?php $form = \yii\bootstrap\ActiveForm::begin(['method'=>'POST','options'=>['id'=>'authForm','class'=>'main-form full']]); ?>
                            <div class="row">
                                <div class="col-xs-12 mb-20">
                                    <div class="heading-part heading-bg">
                                        <h2 class="heading">Войти</h2>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <?=$form->field($model, 'email')->textInput();?>
                                </div>
                                <div class="col-xs-12 mb-20">
                                    <?=$form->field($model, 'password_hash')->passwordInput();?>
                                </div>

                                <div class="col-xs-12">
                                    <?=$form->field($model, 'rememberMe')->checkbox([
                                        'id' => 'remember_me',
                                        'class'=>'checkbox',
                                        'template' =>
                                            "<div class=\"check-box left-side\">
                                                <span>
                                                    {input}
                                                    {label}
                                                </span>
                                            </div>",
                                    ])?>
                                    <?=\yii\helpers\Html::submitButton('Войти', ['class'=>'btn-color right-side mb-2'])?>
                                </div>
                                <div class="col-xs-12"> <a href="<?=\yii\helpers\Url::to('/recover')?>" class="forgot-password mtb-20">Забыли пароль?</a>
                                <hr>
                                </div>
                                <div class="col-xs-12">
                                    <div class="new-account align-center mt-20"> <span>Первый раз здесь?</span> <a class="link" title="Register with Electrro" href="<?=\yii\helpers\Url::to('/sign-up')?>">Зарегистрироваться</a> </div>
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