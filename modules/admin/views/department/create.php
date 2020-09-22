<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = 'Добавить отдел';
$this->params['breadcrumbs'][] = ['label' => 'Отделы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-wrap" style="max-width: 600px; margin-left: 15px; margin-right: 15px">
    <div class="department-create">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
