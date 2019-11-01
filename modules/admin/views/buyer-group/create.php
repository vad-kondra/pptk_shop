<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BuyersGroup */

$this->title = 'Создание группы';
$this->params['breadcrumbs'][] = ['label' => 'Группы пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
