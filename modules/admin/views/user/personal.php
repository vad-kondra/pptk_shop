<?php
use app\models\auth\AuthForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelUser app\models\user\User */
/* @var $modelAuthForm AuthForm  */

$this->title = 'Редактирование дополнительной информации';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] = ['label' => $modelUser->getFullName(), 'url' => ['/admin/user/view', 'id' => $modelUser->id] ];
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];

?>

<div class="personal">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'setting_form', 'enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">Общие</div>
                <div class="box-body">
                    <?=$form->field($modelUser, 'f_name')->textInput() ?>
                    <?=$form->field($modelUser, 'l_name')->textInput() ?>
                    <?=$form->field($modelUser, 'p_name')->textInput() ?>
                    <?=$form->field($modelUser, 'company')->textInput() ?>
                    <?=$form->field($modelUser, 'city')->textInput() ?>
                    <?=$form->field($modelUser, 'address')->textInput() ?>
                    <?=$form->field($modelUser, 'post_index')->textInput() ?>

                    <div class="form-group">
                        <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::end(); ?>


</div>
