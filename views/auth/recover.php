<?PHP
$this->title = $title;
$this->params['breadcrumbs'][] =  ['label' => $this->title];
?>


<!-- Recover Account Start -->
<div class="register-account pb-20">
    <div class="container">
        <div class="register-title">
            <h3 class="mb-10">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</h3>
            <p class="mb-10">Если у Вас уже есть учетная запись -  <a class="link" title="Войти" href="<?=\yii\helpers\Url::to(['/sign-in'])?>">войдите на странице входа</a> </p>
        </div>
        <?php $form = \yii\bootstrap\ActiveForm::begin(['method'=>'POST','options'=>['id'=>'authForm','class'=>'main-form full']]); ?>
            <fieldset>
                <legend>Введите эл. почту Вашей учетной записи. Вам будет отправлено письмо с ссылкой для изменения пароля.</legend>
                <div class="form-group">
                    <?=$form->field($model, 'email')->textInput();?>
                </div>
                <div class="buttons newsletter-input">
                    <div class="pull-left">
                        <?=\yii\helpers\Html::submitButton('Принять', ['class'=>'return-customer-btn mr-20'])?>
                    </div>
                </div>
            </fieldset>

            <?php $form = \yii\bootstrap\ActiveForm::end(); ?>
    </div>
    <!-- Container End -->
</div>
<!-- Recover Account End -->
