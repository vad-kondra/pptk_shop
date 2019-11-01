<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\page\UserPage */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => t_app('Статические страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = \yii\bootstrap\ActiveForm::begin() ?>

    <?=$form->field($model, 'name')->textInput()?>

    <?=$form->field($model, 'href')->textInput()?>

    <?=Html::submitButton(t_app('Создать'), ['class' => 'btn btn-success mt-4'])?>
    <?php $form = \yii\bootstrap\ActiveForm::end()?>

</div>
