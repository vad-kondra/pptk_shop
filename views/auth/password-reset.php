<?PHP
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'url' => ['/'.Yii::$app->controller->id . '/' . Yii::$app->controller->action->id],
];
?>



<!-- Recover Account Start -->
<div class="register-account pb-20">
    <div class="container">
        <div class="register-title">
            <h3 class="mb-10">ИЗМЕНЕНИЕ ПАРОЛЯ</h3>
        </div>
        <?php $form = \yii\bootstrap\ActiveForm::begin(['method'=>'POST','options'=>['id'=>'authForm','class'=>'main-form full']]); ?>
        <fieldset>
            <legend>Введите новый пароль для Вашей учетной записи.</legend>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <?=$form->field($model, 'password_hash')->passwordInput()->label('Новый пароль');?>
                    </div>
                    <div class="col-lg-6">
                        <?=$form->field($model, 'password_repeat')->passwordInput() ?>
                    </div>
                </div>
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
