<?php

use app\models\auth\AuthForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\user\User */
/* @var $modelAuthForm AuthForm  */

$this->title = 'Добавление нового пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];
?>

<div class="user-create">
    <div class="row">
        <div class="col-md-6"><div class="box box-primary">
                <div class="box-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'f_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'l_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <!--    --><?//=$form->field( $modelUser, 'company_name')->textInput(['autofocus' => true, 'maxlength' => true]);?>

                    <?= $form->field($model, "phone")->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+38 (099) 999-9999',
                        'clientOptions' => [
                            'clearIncomplete'=>true
                        ]
                    ])?>

                    <?= $form->field($modelAuthForm, 'role')->dropDownList($modelAuthForm->getRoleList(), ['style' => ['width' => '300px'], 'value' => 'user']) ?>

                    <?= $form->field($modelAuthForm, 'password_hash')->passwordInput(['maxlength' => true]) ?>

                    <?= $form->field($modelAuthForm, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

                    <!--    --><?//= $form->field($model, 'is_confirmed')->checkbox()->label($model->getAttributeLabel('is_confirmed')) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php $form = ActiveForm::end(); ?>
                </div>
            </div></div>
    </div>
</div>



