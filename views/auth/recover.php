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
                        <?php
                        $form = \yii\bootstrap\ActiveForm::begin(['method'=>'POST','options'=>['id'=>'authForm','class'=>'main-form full']]);
                        ?>
                        <div class="row">
                            <div class="col-xs-12 mb-10">
                                <div class="heading-part heading-bg">
                                    <h2 class="heading"><?=$title?></h2>
                                </div>
                            </div>
                            <div class="col-xs-12 mb-10">
                                <p>Введите эл. почту Вашей учетной записи. Вам будет отправлено письмо с ссылкой для изменения пароля.</p>
                            </div>
                            <div class="col-xs-12">
                                <?=$form->field($model, 'email')->textInput();?>
                            </div>
                            <div class="col-xs-12">
                                <?=\yii\helpers\Html::submitButton('Принять', ['class'=>'btn-color right-side mb-2'])?>
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