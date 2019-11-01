<?php
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'url' => ['/'.Yii::$app->controller->id . '/' . Yii::$app->controller->action->id],
];

?>

<!--========================
            START SIGNUP AREA
    =================================-->
<section class="signup_area section--padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="cardify signup_form">
                    <div class="login--header">
                        <h3><?=t_app('Отправить заявку')?></h3>
                        <p><?=t_app('Пожалуйста заполните следующие поля соответствующей информацией, чтобы отправить регистрационную заявку.')?>
                        </p>
                    </div>
                    <!-- end .login_header -->

                    <div class="login--form">
                        <?php
                        $fieldClass = 'text_field';
                        $form = \yii\bootstrap\ActiveForm::begin(['options'=>['id'=>'request_form']]);?>

                        <?=$form->field($model, 'company_name')->textInput(['autofocus' => true, 'class' => $fieldClass]);?>

                        <?=$form->field($model, 'username')->textInput(['autofocus' => true, 'class' => $fieldClass]);?>

                        <?=$form->field($model, 'emailAlt')->textInput(['class' => $fieldClass]) ?>
                        <?= \yii\helpers\Html::hiddenInput('UserRequest[phone]', $model->phone,['class'=>'phone_hidden']) ?>

                        <?=$form->field($model, 'phone',['template'=>'{label}<br>{input}{error}'])->textInput(['type'=>'tel','id'=>'phoneRequest', 'class'=>'phoneValue form-control','value'=>''])?>

                        <?=$form->field($model, 'message')->textarea(['class' => $fieldClass])?>
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-12 text-center">
                                <?= \yii\bootstrap\Html::submitButton(t_app('Отправить'), ['class' => 'btn btn--md btn--round register_btn']) ?>
                            </div>
                        </div>
                        <?php $form = \yii\bootstrap\ActiveForm::end(); ?>
                        <div class="login_assist">
                            <p><?=t_app('Уже есть учетная запись?')?>
                                <?=\yii\helpers\Html::a(t_app('Войти'), \yii\helpers\Url::to('/auth/signin'))?>
                            </p>
                        </div>
                    </div>

                    <!-- end .login--form -->
                </div>
                <!-- end .cardify -->
            </div>
            <!-- end .col-md-6 -->
        </div>
        <!-- end .row -->
    </div>
    <!-- end .container -->
</section>
<!--================================
        END SIGNUP AREA
=================================-->
<?php \app\assets\PhoneFieldRequestAsset::register($this);?>