<?php

use app\models\Department;
use app\models\employ\Employ;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Employ */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employ-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_id')->dropDownList(Department::find()->select(['title', 'id'])->indexBy('id')->column()) ?>

    <?= Html::a('Добавить Отдел', ['department/create'], ['class' => 'btn btn-primary', 'target' => '_blank', 'style' => 'margin-bottom: 20px;']) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
