<?PHP
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'url' => ['/'.Yii::$app->controller->id . '/' . Yii::$app->controller->action->id],
];
?>
<!--================================
        START DASHBOARD AREA
=================================-->
<section class="checkout-section ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2">
                        <div class="row">
                            <div class="col-xs-12 mb-20">
                                <div class="heading-part heading-bg">
                                    <h2 class="heading">Изменить пароль</h2>
                                </div>
                            </div>
                            <div class="col-xs-12"><p>Введите новый пароль для Вашей учетной записи.</p></div>
                            <?php $form = \yii\bootstrap\ActiveForm::begin();?>
                                <div class="col-xs-12 mb-20">
                                    <?=$form->field($model, 'password_hash')->passwordInput()->label('Новый пароль');?>
                                </div>
                                <div class="col-xs-12 mb-20">
                                    <?=$form->field($model, 'password_repeat')->passwordInput() ?>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-1 col-lg-12 text-center">
                                        <?= \yii\bootstrap\Html::submitButton('Изменить', ['class' => 'btn btn-color']) ?>
                                    </div>
                                </div>
                            <?php $form = \yii\bootstrap\ActiveForm::end(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================
        END DASHBOARD AREA
=================================-->