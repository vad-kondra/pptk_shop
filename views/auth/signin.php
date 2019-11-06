<?PHP
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];
?>


<!-- LogIn Page Start -->
<div class="log-in pb-60">
    <div class="container">
        <div class="row">
            <!-- New Customer Start -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="new-customer">
                        <h3>НОВЫЙ КЛИЕНТ</h3>
                        <p class="mtb-10"><strong>Регистрация</strong></p>
                        <p>Создав аккаунт, вы сможете совершать покупки быстрее, быть в курсе статуса заказа и отслеживать заказы, которые вы сделали ранее.</p>
                        <a class="customer-btn" href="<?=\yii\helpers\Url::to(['/sign-up'])?>">продолжить</a>
                    </div>
                </div>
            </div>
            <!-- New Customer End -->
            <!-- Returning Customer Start -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="return-customer">
                        <h3 class="mb-10">ПОСТОЯННЫЙ КЛИЕНТ</h3>
                        <p class="mb-10"><strong>Я постоянный клиент</strong></p>
                        <?php $form = \yii\bootstrap\ActiveForm::begin(['method'=>'POST','options'=>['id'=>'authForm']]); ?>
                            <div class="form-group">
                                <?=$form->field($model, 'email')->textInput();?>
                            </div>
                            <div class="form-group">
                                <?=$form->field($model, 'password_hash')->passwordInput();?>
                            </div>
                            <div class="form-group">
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
                            </div>
                            <p class="lost-password"><a href="<?=\yii\helpers\Url::to('/recover')?>">Забыли пароль?</a></p>
                            <?=\yii\helpers\Html::submitButton('Войти', ['class'=>'return-customer-btn'])?>
                        <?php $form = \yii\bootstrap\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <!-- Returning Customer End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- LogIn Page End -->


