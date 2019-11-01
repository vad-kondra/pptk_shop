<?php

use app\models\auth\AuthForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelUser app\models\user\User */
/* @var $modelAuthForm AuthForm  */

$this->title = 'Редактирование профиля пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];

?>

<div class="user-update">
    <div class="float-right mb-3">
        <?= Html::a('Редактировать дополнительную информацию', \yii\helpers\Url::to(['personal', 'id' => $model->id]), ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">Общие</div>
                <div class="box-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($modelUser, 'username')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

                    <?= $form->field($modelUser, 'email')->textInput(['maxlength' => true]) ?>

                    <div class="col-3 pl-0">
                        <?= $form->field($modelUser, "phone")->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+38 (099) 999-9999',
                            'clientOptions' => [
                                'clearIncomplete'=>true
                            ]
                        ])?>
                    </div>

                    <?= $form->field($modelAuthForm, 'role')->dropDownList($modelAuthForm->getRoleList(), ['style' => ['width' => '300px']]) ?>

                    <?= $form->field($modelUser, 'is_confirmed')->checkbox()?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>


